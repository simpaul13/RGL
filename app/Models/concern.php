<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Pagination;
class concern extends Model
{
    use HasFactory, SoftDeletes, Pagination;

    protected $fillable = [
        'type',
        'type_aircon',
        'horset_power',
        'schedule_id',
        'user_id',
        'customer_id',
        'created_by',
        'modified_by'
    ];

    protected $primaryKey = 'concern_id';

    public function scopeJoinShedule($query)
    {
        $query->addSelect(['*']);

        $query->leftjoin('schedules', 'schedules.schedules_id', '=', 'concerns.schedule_id');

        return $query;
    }

    public function scopeJoinCustomer($query)
    {
        $query->addSelect(['*']);

        $query->join('customers', 'customers.customer_id', '=', 'concerns.customer_id');

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

