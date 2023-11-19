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

}

