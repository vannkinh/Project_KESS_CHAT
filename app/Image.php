<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function room(){
        return $this->belongsTo(Room::class, 'id');
    }
    public function table(){
        return $this->belongsTo(Table::class, 'id');
    }
}
