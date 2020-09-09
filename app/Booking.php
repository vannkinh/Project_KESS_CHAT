<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookingItem()
    {
        return $this->hasOne(Booking::class, 'bookingItem_id');
    }
}
