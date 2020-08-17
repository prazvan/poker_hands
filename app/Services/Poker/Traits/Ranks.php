<?php

namespace App\Services\Poker\Traits;

/**
 * Trait Ranks
 * @package App\Services\Poker\Traits
 */
trait Ranks
{
    /**
     * Central to the Cactus Kev algorithm is the idea of
     * associating a prime number with each card rank:
     *
     * The beauty of this system is that if you multiply the prime values of the
     * rank of each card in your hand, you get a unique product,
     * regardless of the order of the five cards.
     * Since multiplication is one of the fastest calculations a computer can make,
     * we have shaved hundreds of milliseconds off our time had we been forced to sort each hand before evaluation.
     *
     * More care be found
     * here: https://www.codingthewheel.com/archives/poker-hand-evaluator-roundup/#cactus_kev
     * and here: http://suffe.cool/poker/evaluator.html
     *
     *   Rank	Deuce	Trey	Four	Five	Six	Seven	Eight	Nine Ten	Jack	Queen	King	Ace
     *   Prime	2	3	5	7	11	13	17	19	23	29	31	37	41
     *
     *
     * @var array $ranks
     */
    public static $ranks = [
        '2' => 2,
        '3' => 3,
        '4' => 5,
        '5' => 7,
        '6' => 9,
        '7' => 11,
        '8' => 13,
        '9' => 17,
        'T' => 19,
        'J' => 23,
        'Q' => 29,
        'K' => 31,
        'A' => 37
    ];
}