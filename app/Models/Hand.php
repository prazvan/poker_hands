<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Model,
    Relations\BelongsTo,
    SoftDeletes
};

/**
 * Class Hand
 *
 * @package App\Models
 */
class Hand extends Model
{
    /**
     * @uses soft deletes
     */
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hand_played_id',
        'cards',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get Hand Game Report
     *
     * @return BelongsTo
     */
    public function gameReport(): BelongsTo
    {
        return $this->belongsTo(HandsPlayed::class);
    }
}