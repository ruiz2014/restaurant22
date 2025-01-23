<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_Order extends Model
{
    protected $table = 'temp_orders';
    use HasFactory;

    protected $fillable = ['code', 'table_id', 'order_id', 'amount', 'price', 'status', 'business_id'];

    public function table()
    {
        return $this->hasOne('App\Models\Room\Table', 'id', 'table_id');
    }
}
