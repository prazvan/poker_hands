<?php

namespace App\Services\Reports\Types;

use App\Services\Parsers\PokerHands\PokerHandsParser;
use App\Services\Reports\Contracts\ReportContract;
use App\Services\Poker\HandEvaluator;
use Illuminate\Support\Collection;
use App\Repositories\Eloquent\{
    GameReportRepository,
    HandsPlayedRepository,
    HandRepository

};

/**
 * Generates Poker Hands Report
 *
 * @package App\Services\Reports\Types
 */
final class Poker implements ReportContract
{
    /**
     * Data to parse
     *
     * @var Collection $dataCollection
     */
    protected Collection $data;

    /**
     * @var PokerHandsParser
     */
    private $pokerHandsParser;

    /**
     * @var GameReportRepository $GameReportRepository
     */
    private $GameReportRepository;

    /**
     * @var HandsPlayedRepository $HandsPlayedRepository
     */
    private $HandsPlayedRepository;

    /**
     * @var HandRepository $HandRepository
     */
    private $HandRepository;

    /**
     * Poker constructor.
     * @param Collection $data
     */
    public function __construct(Collection $data)
    {
        // set raw data
        $this->data = $data;

        // init new hands parser set the data to it
        $this->pokerHandsParser = (new PokerHandsParser())
            ->setHandsCollection($this->data);

        // init needed repositories
        $this->GameReportRepository = GameReportRepository::make();
        $this->HandsPlayedRepository = HandsPlayedRepository::make();
        $this->HandRepository = HandRepository::make();
    }

    /**
     * Process current report and do a callback when all is finished
     *
     * @param callable $callback
     */
    public function process(callable  $callback): void
    {
        // process poker hands
        $this->pokerHandsParser->process();

        // create the report
        $report_id = $this->createReport();

        // set back the report id and how many hands where processed
        $callback(...[$report_id, $this->pokerHandsParser->records()->count()]);
    }

    /**
     * Get All Reports For the Given User ID
     *
     * @param int $user_id
     * @return Collection
     */
    public function getReportsForUser(int $user_id): Collection
    {
        return $this->GameReportRepository->all($user_id);
    }

    /**
     * Create Report
     *
     * @return int
     */
    private function createReport(): int
    {
        // first create report
        $report_id = $this->GameReportRepository->create();

        // parse hands
        $hands_played = $this->parseHandsForReport($report_id);

        // update the hands played and report
        $this->updateHandsPlayedAndReport($report_id, $hands_played);

        // all good we can return the report id
        return $report_id;
    }

    /**
     * Parse Poker Hands and save them to Database
     *
     * @param $report_id
     * @return array
     */
    private function parseHandsForReport($report_id): array
    {
        // parse each hand
        $hands_played = [];
        $this->pokerHandsParser->records()->each(function ($hands, $index) use (&$hands_played, $report_id)
        {
            // for each hand create a new Hand Played Object
            $hands_played_Id = $this->HandsPlayedRepository->create([
                'game_report_id' => $report_id
            ]);

            // set the new hand id
            $hands_played[$index]['hands_played_Id'] = $hands_played_Id;

            // before we evaluate the hands, let's save them
            foreach ($hands as $i => $hand)
            {
                // store hand in db
                $hand_id = HandRepository::make()->create($hands_played_Id, $hand);

                $hands_played[$index]['hands'][$i] = [
                    'hand_score' => HandEvaluator::make($hand)->evaluate(),
                    'hand_id'    => $hand_id
                ];
            }
        });

        return $hands_played;
    }

    /**
     * @param int $report_id
     * @param array $hands_played
     */
    private function updateHandsPlayedAndReport($report_id, array $hands_played): void
    {
        // format payload and select winning players
        $payload = $this->determinateHandsWinners($hands_played);

        $total_hands = 0;

        foreach ($payload['hands'] as $hand)
        {
            $this->HandsPlayedRepository->create([
                'id'             => $hand['id'],
                'game_report_id' => $report_id,
                'won_by'         => $hand['won_by'],
            ]);

            $total_hands++;
        }

        // update report
        $this->GameReportRepository->updateReport($report_id, [
            'player_1_wins' => $payload['totals']['player_1_wins'],
            'player_2_wins' => $payload['totals']['player_2_wins'],
            'ties'          => $payload['totals']['ties'],
            'total_hands'   => $total_hands,
        ]);
    }

    /**
     * Determinate hands winner and return totals
     *
     * @param array $hands_played
     * @return array
     */
    private function determinateHandsWinners(array $hands_played)
    {
        $payload = [
            'totals' => [
                'player_1_wins' => 0,
                'player_2_wins' => 0,
                'ties' => 0,
            ],
            'hands' => []
        ];

        foreach ($hands_played as $index => $handPlayed)
        {
            // set id
            $payload['hands'][$index]['id'] = $handPlayed['hands_played_Id'];

            // split by player
            [$player1, $player2] = $handPlayed['hands'];

            switch (true)
            {
                case ($player1['hand_score'] < $player2['hand_score']):

                    $payload['hands'][$index]['won_by'] = 'player 1';
                    $payload['totals']['player_1_wins'] += 1;

                    break;

                case ($player1['hand_score'] > $player2['hand_score']):

                    $payload['hands'][$index]['won_by'] = 'player 2';
                    $payload['totals']['player_2_wins'] += 1;

                    break;

                case ($player1['hand']['hand_score'] === $player2['hand_score']):

                    $payload['hands'][$index]['won_by'] = 'tie';
                    $payload['totals']['ties'] += 1;

                    break;
            }
        }

        // return proper payload and totals
        return $payload;
    }
}