<?php

namespace App\Models\Biller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function attention()
    {
        return $this->hasOne('App\Models\Biller\Attention', 'id', 'attention_id');
    }

    // public function attention()
    // {
    //     return $this->hasMany('App\Models\Biller\Attention', 'attention_id', 'id');
    // }
}
