<?php

namespace App\Services\Poker\Calculator\Hands;

/**
 * Trait Flushes
 *
 * @package App\Services\Poker\Calculator\Hands
 */
trait Flush
{
    /**
     * Calculates all possible combos for flushes and add it to the matrix
     * @param bool $suited
     */
    protected function calculateFlushes(bool $suited = false): void
    {
        for ($a = 12; $a >= 0; $a--)
        {
            for ($b = $a - 1; $b >= 0; $b--)
            {
                for ($c = $b - 1; $c >= 0; $c--)
                {
                    for ($d = $c - 1; $d >= 0; $d--)
                    {
                        for ($e = $d - 1; $e >= 0; $e--)
                        {
                            if ($a - 4 != $e)
                            {
                                // flushes
                                $this->calculateScore([
                                    $this->cards[$a],
                                    $this->cards[$b],
                                    $this->cards[$c],
                                    $this->cards[$d],
                                    $this->cards[$e]
                                ], $suited);
                            }
                        }
                    }
                }
            }
        }
    }
}