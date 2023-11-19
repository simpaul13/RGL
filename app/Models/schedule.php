<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    use HasFactory;

    public function scopeJoinConcern($query)
    {
        $query->addSelect(['*']);

        $query->join('concerns', 'concerns.schedule_id', '=', 'schedules.schedules_id');

        return $query;
    }
}
