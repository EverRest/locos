<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;

/**
 * Class PetResource
 * @package App\Models
 */
class Pet extends Model
{
    use HasFactory, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_id',
        'name',
        'years',
        'description'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'type_id' => 'integer',
        'name' => 'string',
        'years' => 'integer',
        'description' => 'string',
    ];

    /**
     * @var string[]
     */
    public $sortable = [
        'type_id',
        'name',
        'years'
    ];

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(PetType::class);
    }

    /**
     * @return BelongsToMany
     */
    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_pets');
    }

    /**
     * @return HasMany
     */
    public function accidents(): HasMany
    {
        return $this->hasMany(Accident::class);
    }
}
