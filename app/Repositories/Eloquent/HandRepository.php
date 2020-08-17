<?php

namespace App\Repositories\Eloquent;

use App\Models\Hand;
use App\Services\Poker\Card;
use Illuminate\Support\Collection;

/**
 * Class HandRepository
 * @package App\Repositories\Eloquent
 */
class HandRepository extends EloquentRepository
{
    /**
     * Store hands
     *
     * @param int $hand_played_id
     * @param Collection $hand
     * @return int
     */
    public function create(int $hand_played_id, Collection $hand): int
    {
        // glue cards into a string
        $cards = implode(" ", $hand->map(function(Card $card) {
            return $card->__toString();
        })->toArray());

        // create hand and return id
        return (Hand::create(['hand_played_id' =>$hand_played_id, 'cards' => $cards]))->id;
    }
}