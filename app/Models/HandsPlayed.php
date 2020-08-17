<?php

namespace App\Models;

use Hands;
use Illuminate\Database\Eloquent\{
    Model,
    Relations\BelongsTo,
    Relations\HasMany,
    SoftDeletes
};

/**
 * Class HandsPlayed
 * @package App\Models
 */
class HandsPlayed extends Model
{
    /**
     * @uses soft deletes
     */
    use SoftDeletes;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'hands_played';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'game_report_id' => 0,
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_report_id',
        'won_by'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return BelongsTo
     */
    public function gameReport(): BelongsTo
    {
        return $this->belongsTo(GameReport::class);
    }

    /**
     * Get Hands
     *
     * @return HasMany
     */
    public function hands(): HasMany
    {
        return $this->hasMany(Hands::class);
    }
}
