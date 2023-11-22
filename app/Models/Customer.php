<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Pagination;

class Customer extends Model
{
    use HasFactory, SoftDeletes, Pagination;

    protected $fillable = [
        'customer_firstname',
        'customer_lastname',
        'customer_middlename',
        'customer_gender',
        'email',
        'company',
        'contact_number',
        'country',
        'province',
        'city',
        'barangay',
        'zipcode',
        'additional_information',
        'created_by',
        'modified_by',
    ];

    protected $primaryKey = 'customer_id';

    public function scopeSelectedFields($query)
    {
        return $query->select(["{$this->getTable()}.*"]);
    }

    /*
    |--------------------------------------------------------------------------
    | Decrypt Data
    |--------------------------------------------------------------------------
    */

    public function getContactPersonAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function getContactNumberAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function getProvinceAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function getCityAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function getBarangayAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function getAdditionalInformationAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function getCustomerFirstnameAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function getCustomerLastnameAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function getCustomerMiddlenameAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function getEmailAttribute($value)
    {
        return Crypt::decrypt($value);
    }
}
