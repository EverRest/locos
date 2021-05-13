<?php


namespace App\Models;

/**
 * Class UserPet
 *
 * @package App\Models
 */
class UserPet
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pet_id',
        'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string',
    ];
}