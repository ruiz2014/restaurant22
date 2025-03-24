<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 *
 * @property $id
 * @property $name
 * @property $tipo_doc
 * @property $document
 * @property $phone
 * @property $address
 * @property $email
 * @property $ubigeo
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Customer extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'tipo_doc', 'document', 'phone', 'address', 'email', 'ubigeo', 'status'];

    public function attentions()
    {
        return $this->hasMany('App\Models\Biller\Attention', 'customer_id', 'id');
    }
}
