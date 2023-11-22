<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

        return $query;
    }
}
