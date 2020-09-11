<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function room()
    {
        return $this->hasMany(Room::class, 'shop_id');
    }
    protected $table = "shops";
}
