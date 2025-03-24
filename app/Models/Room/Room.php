<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $perPage = 20;
    protected $guarded = []; 
    // protected $fillable = ['name', 'status'];

    public function table()
    {
        return $this->hasMany('App\Models\Room\Table', 'room_id', 'id');
    }
}