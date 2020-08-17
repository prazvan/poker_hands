<?php

namespace App\Repositories\Eloquent;

use App\Models\HandsPlayed;

/**
 * Class HandRepository
 * @package App\Repositories\Eloquent
 */
class HandsPlayedRepository extends EloquentRepository
{
    /**
     * Create new Hands Played
     *
     * @param array $payload
     * @return int
     */
    public function create(array $payload): int
    {
        return (HandsPlayed::updateOrCreate($payload))->id;
    }
}