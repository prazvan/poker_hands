<?php

namespace App\Services\Poker\Calculator\Hands;

/**
 * Trait TowPairs
 *
 * @package App\Services\Poker\Calculator\Hands
 */
trait TowPairs
{
    /**
     * Calculate two pairs
     */
    protected function calculateTwoPairs(): void
    {
        for ($a = 12; $a >= 0; $a--)
        {
            for ($b = $a - 1; $b >= 0; $b--)
            {
                for ($c = 12; $c >= 0; $c--)
                {
                    // make sure cards are not identical
                    if ($a != $b && $a != $c && $b != $c)
                    {
                        $this->calculateScore([

                            // adds pair 1
                            $this->cards[$a],
                            $this->cards[$a],

                            // adds pair 2
                            $this->cards[$b],
                            $this->cards[$b],

                            // adds blank
                            $this->cards[$c]
                        ]);
                    }
                }
            }
        }
    }
}