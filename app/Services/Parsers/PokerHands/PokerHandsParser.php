<?php

namespace App\Services\Parsers\PokerHands;

use App\Services\Parsers\Contracts\ParserContract;
use App\Services\Poker\Card;
use Illuminate\Support\Collection;

/**
 * Class PokerHandsParser
 *
 * @package App\Services\Parsers\File
 */
final class PokerHandsParser implements ParserContract
{
    /**
     * Collection of poker hands
     *
     * @var Collection$handsCollection
     */
    private Collection $handsCollection;

    /**
     * Set collection with poker hands to parse
     *
     * @param Collection $handsCollection
     * @return PokerHandsParser
     */
    public function setHandsCollection(Collection $handsCollection): self
    {
        $this->handsCollection = $handsCollection;
        return $this;
    }

    /**
     * Process give file
     */
    public function process(): void
    {
        $this->handsCollection->each(function ($item, $index) use (&$newColl)
        {
            $this->handsCollection->offsetSet($index, $this->parseHand($item));
        });
    }

    /**
     * TODO: we assumed that each hand is in valid format.
     * TODO: maybe implement a hand validation
     * TODO: for validation check that we actually have a hand in this format "8C TS KC 9H 4S 7D 2S 5D 3S AC".
     *
     * @param string $hand
     * @return array
     */
    private function parseHand(string $hand): array
    {
        // we assume the hand is valid so we can just split the string after 14 chars
        [$player1_cards, $player2_cards] = str_split($hand, 15);

        // parse each card
        $initCards = function(string $cards)
        {
            $cards = Collection::make(explode(self::DELIMITER, trim($cards)));

            // for each card in the collection init a new Card and overwrite the string one.
            $cards->each(function ($card, $index) use (&$cards)
            {
                $cards->offsetSet($index, new Card($card[0], $card[1]));
            });

            return $cards;
        };

        // return each hand as a collection
        return [$initCards($player1_cards), $initCards($player2_cards)];
    }

    /**
     * Returns Array with records
     *
     * @return Collection
     */
    public function records(): Collection
    {
       return $this->handsCollection;
    }

    /**
     * Return count of records
     *
     * @return int
     */
    public function count(): int
    {
        return $this->handsCollection->count();
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->handsCollection->toArray();
    }
}