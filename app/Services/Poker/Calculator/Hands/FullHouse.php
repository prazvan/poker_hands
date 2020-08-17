<?php

namespace App\Services\Poker\Calculator\Hands;

/**
 * Trait FullHouse
 * @package App\Services\Poker\Calculator\Hands
 */
trait FullHouse
{
    /**
     * Calculates all possible combos for full and add it to the matrix
     */
    protected function calculateFullHouse(): void
    {
        for ($i = 12; $i >= 0; $i--)
        {
            for ($k = 12; $k >= 0; $k--)
            {
                // makes sure that we have $I = same suit and $K same suit but different from each other
                if ($k != $i)
                {
                    $this->calculateScore([

                        // three of a kind
                        $this->cards[$i],
                        $this->cards[$i],
                        $this->cards[$i],

                        // pair
                        $this->cards[$k],
                        $this->cards[$k]
                    ]);
                }
            }
        }
    }
}