<?php

namespace App\Services\Poker\Calculator;

use App\Services\Helpers\Singleton;
use App\Services\Poker\
{
    Calculator\Hands\Flush,
    Calculator\Hands\FullHouse,
    Calculator\Hands\Pairs,
    Calculator\Hands\Quads,
    Calculator\Hands\Straights,
    Calculator\Hands\ThreeOfAKind,
    Calculator\Hands\TowPairs,
    Traits\CardsScore,
    Card
};

/**
 * Class HandsCalculator
 *
 * Based on Cactus Kev's Poker Hand Evaluator
 * @see: http://suffe.cool/poker/evaluator.html
 *
 * Also this can be implemented with a perfect hash algo, that basically created a binary file with all the hands
 * and then the only thing needed is to calculate the hash for the hand and look it up, should be way faster,
 * a approach or implementation of this can be found here: http://senzee.blogspot.com/2006/06/some-perfect-hash.html
 *
 * @package App\Services\Poker\Calculator
 */
final class HandsCalculator
{
    /**
     * Suited Hands Scores calculations
     *
     * this are as following 41⁵, 43⁵, 47⁵, 53⁵
     * or pow(41...53, 5) in php terms;
     */
    public const SUIT_SPADES_SCORE  = 115856201;
    public const SUIT_DIAMOND_SCORE = 147008443;
    public const SUIT_HEARTS_SCORE  = 229345007;
    public const SUIT_CLUBS_SCORE   = 418195493;

    /**
     * Matrix representing suited values
     */
    public const SUITED_SCORES_MAP = [
        self::SUIT_SPADES_SCORE,
        self::SUIT_DIAMOND_SCORE,
        self::SUIT_HEARTS_SCORE,
        self::SUIT_CLUBS_SCORE,
    ];

    /**
     * Used for calculating score for hands that are suited
     */
    public const SUITED_PRIME = 59;

    /**
     * Each hand type is encapsulated into a trait
     */
    use Singleton, CardsScore, Pairs, TowPairs, ThreeOfAKind, Straights, Flush, FullHouse, Quads;

    /**
     * Array with all hand Rankings
     *
     * @var array
     */
    private $handsRanking = [];

    /**
     * @var int $calculated
     */
    private $calculated = 1;

    /**
     * HandsCalculator constructor.
     */
    private function __construct()
    {
        // generate a "deck of cards" from 2 to A same suit
        self::generateMockedDeck();

        /**
         * Calculates the Hands Matrix based on Cactus Kev's Poker Hand Evaluator
         *
         * results in 7462 distinct poker hand values in the matrix
         */
        $this->calcualteHandsMatrix();
    }

    /**
     * Main Method of score calculation
     *
     * This Method is called by all the hands combos.
     * in one word in creates the hands matrix
     *
     * @param array $cards
     * @param bool $suited
     */
    private function calculateScore(array $cards, $suited = false): void
    {
        $rank = 1;

        /**
         *  Multiply each card score
         * @var Card $card
         */
        foreach ($cards as $card)
        {
            $rank *= $card->getCardRankScore();
        }

        // if cards are multiple with the next prime number in the sequence
        if ($suited)
        {
            $rank *= self::SUITED_PRIME;
        }

        $this->handsRanking[$rank] = ++$this->calculated;
    }

    /**
     * Get Hands Ranking Count
     *
     * @return int
     */
    public function getHandsRankingCount(): int
    {
        return count($this->handsRanking) + 1;
    }

    /**
     * Get Hands Ranking Count
     *
     * @return array
     */
    public function getHandsRanking(): array
    {
        return $this->handsRanking;
    }

    /**
     * Calculate Hands Matrix
     */
    private function calcualteHandsMatrix(): void
    {
        // calculate Straight flushes and royal
        $this->calculateStraights(true);

        // calculate 4 of a kind
        $this->calculateQuads();

        // calculate full's
        $this->calculateFullHouse();

        // calculate flushes
        $this->calculateFlushes(true);

        // calculate Straights
        $this->calculateStraights();

        // calculate 3 of a kind
        $this->calculateThreeOfAKind();

        // calculate two pairs
        $this->calculateTwoPairs();

        // calculate pair
        $this->calculatePairs();

        // calculate flushes
        $this->calculateFlushes();
    }

}