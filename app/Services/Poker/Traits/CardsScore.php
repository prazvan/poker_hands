<?php

namespace App\Services\Poker\Traits;

use App\Services\Poker\Card;

/**
 * Trait CardsValues
 *
 * @package App\Services\Poker\Traits
 */
trait CardsScore
{
    /**
     * @var array
     */
    private array $cards = [];

    /**
     * Generates an Array of Cards Score, this is used to add "extra" score for each hand type
     */
    private function generateMockedDeck()
    {
        foreach (Card::$ranks as $rank => $value)
        {
            $this->cards[] = new Card($rank, 'C');
        }
    }
}