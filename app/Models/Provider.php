<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Provider
 *
 * @property $id
 * @property $name
 * @property $document
 * @property $contact
 * @property $phone
 * @property $address
 * @property $ubigeo
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Provider extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'document', 'contact', 'phone', 'address', 'ubigeo', 'status'];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'provider_id', 'id');
    }
}
