<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function bookingItem()
    {
        return $this->hasMany(BookingItem::class, 'booking_id');
    }
}
