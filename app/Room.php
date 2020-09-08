<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "rooms";

    protected $fillable = [
        'name',
        'max_people',
        'floor',
        'price',
        'special_price',
        'shop_id',
        'deposit',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];
}
