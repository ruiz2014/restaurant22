<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Table
 *
 * @property $id
 * @property $identifier
 * @property $room_id
 * @property $place_id
 * @property $observation
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Table extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['identifier', 'room_id', 'place_id', 'observation', 'status'];

    public function temp_order()
    {
        return $this->hasMany('App\Models\Temp_Order', 'table_id', 'id');
    }

    public function room()
    {
        return $this->hasOne('App\Models\Room\Room', 'id', 'room_id');
    }
}
