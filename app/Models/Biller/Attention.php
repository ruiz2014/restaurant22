<?php

namespace App\Models\Biller;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Attention extends Model
{
    // protected $fillable = ['name', 'status'];
    protected $guarded = []; 

    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }

    public function payLog()
    {
        return $this->hasMany('App\Models\Biller\PaymentLog', 'attention_id', 'id');
    }

    public function voucher()
    {
        return $this->hasOne('App\Models\Biller\Voucher', 'sunat_code', 'sunat_code');
    }
}