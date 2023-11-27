<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_date',
        'status',
        'created_by',
        'modified_by'
    ];

    protected $primaryKey = 'schedules_id';

    public function scopeJoinConcern($query)
    {
        $query->addSelect(['*']);

        $query->join('concerns', 'concerns.schedule_id', '=', 'schedules.schedules_id');

        $query->leftjoin('customers', 'customers.customer_id', '=', 'concerns.customer_id');

        return $query;
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
