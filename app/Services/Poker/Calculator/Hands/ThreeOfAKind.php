<?php


namespace App\Services\Poker\Calculator\Hands;

/**
 * Trait ThreeOfAKind
 *
 * @package App\Services\Poker\Calculator\Hands
 */
trait ThreeOfAKind
{
    /**
     * Calculate Three Of A Kind Score
     */
    protected function calculateThreeOfAKind(): void
    {
        for ($a = 12; $a >= 0; $a--)
        {
            for ($b = 12; $b >= 0; $b--)
            {
                for ($c = $b - 1; $c >= 0; $c--)
                {
                    if ($a != $b && $a != $c)
                    {
                        $this->calculateScore([

                            // 3 of a kind
                            $this->cards[$a],
                            $this->cards[$a],
                            $this->cards[$a],

                            // blanks
                            $this->cards[$b],
                            $this->cards[$c]
                        ]);
                    }
                }
            }
        }
    }
}