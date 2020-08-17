<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model,
    Relations\HasMany,
    SoftDeletes
};

/**
 * Class GameReport
 * @package App\Models
 */
class GameReport extends Model
{
    /**
     * @uses soft deletes
     */
    use SoftDeletes;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'user_id'       => 0,
        'player_1_wins' => 0,
        'player_2_wins' => 0,
        'ties'          => 0,
        'total_hands'   => 0,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'player_1_wins',
        'player_2_wins',
        'ties',
        'total_hands',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Mutate attributes after query
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:m:s',
    ];

    /**
     * Get Hands Played Relationship
     *
     * @return HasMany
     */
    public function handsPlayed(): HasMany
    {
        return $this->hasMany(HandsPlayed::class);
    }
}