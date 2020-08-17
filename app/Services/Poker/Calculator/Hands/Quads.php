<?php

namespace App\Services\Poker\Calculator\Hands;

/**
 * Trait Quads
 *
 * @package App\Services\Poker\Calculator\Hands
 */
Trait Quads
{
    /**
     * Calculate Quads
     */
    protected function calculateQuads(): void
    {
        for ($i = 12; $i >= 0; $i--)
        {
            for ($k = 12; $k >= 0; $k--)
            {
                if ($k != $i)
                {
                    $this->calculateScore([

                        // 4 of a kind
                        $this->cards[$i],
                        $this->cards[$i],
                        $this->cards[$i],
                        $this->cards[$i],

                        // blank
                        $this->cards[$k]
                    ]);
                }
            }
        }
    }
}