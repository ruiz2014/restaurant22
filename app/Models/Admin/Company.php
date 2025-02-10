<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function company_data()
    {
        return $this->hasOne('App\Models\Admin\CompanyData', 'company_id', 'id');
    }
}
