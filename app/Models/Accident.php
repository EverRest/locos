<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Kyslik\ColumnSortable\Sortable;

/**
 * Class AccidentResource
 * @package App\Models
 */
class Accident extends Model
{
    use HasFactory, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pet_id',
        'user_id',
        'city',
        'coordinates',
        'accident'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'pet_id' => 'integer',
        'user_id' => 'integer',
        'city' => 'string',
        'accident' => 'string',
        'coordinates' => 'string'
    ];
    /**
     * @var string[]
     */
    public $sortable = [
        'pet_id',
        'user_id',
        'city',
        'coordinates',
        'created_at',
        'updated_at'
    ];

    /**
     * @return MorphToMany
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Get user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get user.
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * @return HasMany
     */
    public function accidents(): HasMany
    {
        return $this->hasMany(Accident::class);
    }
}
