<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $product_type
 * @property $group
 * @property $price
 * @property $category_id
 * @property $provider_id
 * @property $stock
 * @property $minimo
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Product extends Model
{
    
    protected $perPage = 20;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'description', 'product_type', 'group', 'price', 'category_id', 'provider_id', 'stock', 'minimo', 'status'];

    public function provider()
    {
        return $this->hasOne('App\Models\Provider', 'id', 'provider_id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    // public function service()
    // {
    //     return $this->hasOne('App\Models\Service', 'id', 'service_id');
    // }

    // public function attentions()
    // {
    //     return $this->hasMany('App\Models\Attention', 'product_id', 'id');
    // }

//     public function getnamePriceAttribute()
// {
//     return $this->name . ' ' . $this->price;
// }
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => $this->name. ' '.$this->price,
        );
    }
}
