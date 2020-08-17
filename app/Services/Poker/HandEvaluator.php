<?php

namespace App\Services\Poker;

use App\Services\Helpers\Singleton;
use App\Services\Poker\Calculator\HandsCalculator;
use Illuminate\Support\Collection;
use Exception;

/**
 * Class HandEvaluator
 *
 * @property  handsCalculator
 *
 * @package App\Services\Poker
 */
final class HandEvaluator
{
    use Singleton;

    /**
     * @var handsCalculator $handsCalculator
     */
    private HandsCalculator $handsCalculator;

    /**
     * @var Collection $hand
     */
    public Collection $hand;
    /**
     * @var int
     */
    private $highest;

    /**
     * Singleton Instance
     *
     * @param $hand
     * @return HandEvaluator
     */
    public static function make(Collection $hand): self
    {
        return new static(HandsCalculator::make(), $hand);
    }

    /**
     * HandEvaluator constructor.
     *
     * @param HandsCalculator $handsCalculator
     *
     * @param Collection $hand
     */
    private function __construct(HandsCalculator $handsCalculator, Collection $hand)
    {
        // set calculator
        $this->handsCalculator = $handsCalculator;

        // set hand
        $this->hand = $hand;
    }

    /**
     * Evaluate Current Hand Score
     *
     * @return int
     *
     * @throws Exception
     */
    public function evaluate(): int
    {
        // if there less then five cards return 0
        if ($this->hand->count() < 5)
        {
            throw new Exception('hand cannot be evaluated');
        }

        return $this->calculateCurrentHand();
    }

    /**
     * get Current hand score
     *
     * @return int
     * @throws Exception
     */
    private function calculateCurrentHand(): int
    {
        // get the current hand scores
        [$cards_rank_score, $cards_suit_score] = $this->getCurrentHandScores();

        // check for the proper hand ranking
        $hand_rank_score = $this->handsCalculator->getHandsRanking()[$cards_rank_score];

        // if the current  hand is suited
        if (in_array($cards_suit_score, $this->handsCalculator::SUITED_SCORES_MAP))
        {
            // multiply current rank score by suited
            $cards_rank_score *= $this->handsCalculator::SUITED_PRIME;

            // get suited score
            $suited_score = $this->handsCalculator->getHandsRanking()[$cards_rank_score];

            if ($suited_score < $hand_rank_score)
            {
                $hand_rank_score = $suited_score;
            }
        }

        return $hand_rank_score;
    }

    /**
     * Calculates current Hand Scores
     *
     * @return array
     */
    private function getCurrentHandScores(): array
    {
        $rank_score = 1;
        $suit_score = 1;

        $this->hand->each(function(Card $card) use (&$rank_score, &$suit_score)
        {
            $rank_score *= $card->getCardRankScore();
            $suit_score *= $card->getCardSuitScore();
        });

        return [$rank_score, $suit_score];
    }
}