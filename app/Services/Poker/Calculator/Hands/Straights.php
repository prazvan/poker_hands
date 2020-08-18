<?php

namespace App\Services\Poker\Calculator\Hands;

use App\Services\Poker\Card;

/**
 * Trait Straights
 *
 * @package App\Services\Poker\Calculator\Hands
 */
trait Straights
{
    /**
     * @param bool $suited
     */
    protected function calculateStraights(bool $suited = false): void
    {
        for ($i = 12; $i > 2; $i--)
        {
            $cards = [
                $this->cards[$i],
                $this->cards[$i-1],
                $this->cards[$i-2],
                $this->cards[$i-3]
            ];

            // make sure to include the ace on low straights
            if ($i > 3)
            {
                $cards[] = $this->cards[$i-4];
            }
            else
            {
                $cards[] = (new Card('A','S'));
            }

            // include royal
            $this->calculateScore($cards, $suited);
        }
    }
}
