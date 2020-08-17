<?php

namespace App\Services\Poker\Traits;

/**
 * Trait Ranks
 * @package App\Services\Poker\Traits
 */
trait Suits
{
    /**
     * Same as we card number we assign a prime number to suits also.
     *
     * @var array $suits
     */
    public static $suits = [
        'c' => 41,
        'C' => 41,

        'd' => 43,
        'D' => 43,

        'h' => 47,
        'H' => 47,

        's' => 53,
        'S' => 53,
    ];
}