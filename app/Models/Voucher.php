<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Voucher
 *
 * @property $id
 * @property $user_id
 * @property $name
 * @property $sunat_code
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Voucher extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'name', 'sunat_code'];


}
