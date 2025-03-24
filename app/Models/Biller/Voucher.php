<?php

namespace App\Models\Biller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $perPage = 20;
    protected $fillable = ['user_id', 'name', 'sunat_code'];
}
