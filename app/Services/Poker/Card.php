<?php

namespace App\Services\Poker;

use App\Services\Poker\Traits\{
    Ranks, Suits
};

use Illuminate\Support\Collection;

/**
 * Class Card
 *
 * @package App\Services\Poker
 */
final class Card
{
    use Ranks, Suits;

    /**
     * @var static
     */
    private Collection $card;

    /**
     * Card constructor.
     *
     * @param $rank
     * @param $suit
     */
    public function __construct(string $rank, string $suit)
    {
        $this->card = Collection::make([
            // set rank and suit
            'rank' => $rank,
            'suit' => $suit,

            // set proper scores for both rank and suit
            'rank_score' => self::$ranks[strtoupper($rank)],
            'suit_score' => self::$suits[strtoupper($suit)]
        ]);
    }

    /**
     * Return All the Card Information
     *
     * @return Collection
     */
    public function getCard(): Collection
    {
        return $this->card;
    }

    /**
     * @return string
     */
    public function getCardRank(): string
    {
        return $this->card->offsetGet('rank');
    }

    /**
     * @return string
     */
    public function getCardSuit(): string
    {
        return $this->card->offsetGet('suit');
    }

    /**
     * @return int
     */
    public function getCardRankScore(): int
    {
        return $this->card->offsetGet('rank_score');
    }

    /**
     * @return int
     */
    public function getCardSuitScore(): int
    {
        return $this->card->offsetGet('suit_score');
    }

    /**
     * Get card as String
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getCardRank()."".$this->getCardSuit();
    }
}