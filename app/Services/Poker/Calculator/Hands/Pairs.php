<?php

namespace App\Services\Poker\Calculator\Hands;

/**
 * Calculate Pairs Score
 *
 * @package App\Services\Poker\Calculator\Hands
 */
trait Pairs
{
    /**
     * Calculates all possible combos for 1 par and add it to the matrix
     */
    protected function calculatePairs(): void
    {
        for ($a = 12; $a >= 0; $a--)
        {
            for ($b = 12; $b >= 0; $b--)
            {
                for ($c = $b - 1; $c >= 0; $c--)
                {
                    for ($d = $c - 1; $d >= 0; $d--)
                    {
                        // make sure cards are not the same
                        if ($a != $b && $a != $c && $a != $d && $b != $c && $b != $d && $c != $d)
                        {
                            $this->calculateScore([

                                // pair
                                $this->cards[$a],
                                $this->cards[$a],

                                // blanks
                                $this->cards[$b],
                                $this->cards[$c],
                                $this->cards[$d]]
                            );
                        }
                    }
                }
            }
        }
    }
}