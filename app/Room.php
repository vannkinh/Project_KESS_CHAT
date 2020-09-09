<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function shop(){
        return $this->belongsTo(Shop::class, 'shop_id');
    }

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
