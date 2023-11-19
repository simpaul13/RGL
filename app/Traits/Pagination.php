<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Pagination
{
    // Method for Eloquent Relationship
    public function scopeWithRelations($query)
    {
        $relations = request()->relations;
        $relations_array = [];

        if(!empty($relations)) {
            foreach ($relations as $relation) {
                array_push($relations_array, Str::camel($relation) );
            }

            $query->with($relations_array);
        }

    	return $query;
    }

    // Method for Eloquent Sorting
    public function scopeSortable($query, $order_by = null, $order_action = null)
    {
        $order_by       = request()->order_by ?? $order_by;
        $order_action   = request()->order_action ?? $order_action;

        if(!empty($order_by) && !empty($order_action)) {
            return $query->orderBy($order_by, $order_action);
        }

        return $query->orderBy("{$this->getTable()}.{$this->primaryKey}", 'DESC');
    }

    // Method for Eloquent Searching
    public function scopeSearchable($query, $search = null, $search_field = null)
    {

        $decrypt            = request()->decrypt ?? null;
        $search             = request()->search ?? $search;
        $search_field       = request()->search_field ?? $search_field;
        $searchable_fields  = $this->searchable_fields ?? [];

        if(!empty($search) && !empty($search_field)) {
            return $query->where($search_field, 'LIKE', "%{$search}%");
        }

        if(!empty($search)) {
            $count = 0;
            foreach ($searchable_fields as $index => $field) {

                $method = ($count == 0) ? 'where' : 'orWhere';

                if(is_array($field)){

                    if($field[0] == 'date'){
                        $method = $method.'Date';
                        $query->$method($field,'=',$search);
                    }

                    $count++;
                    continue;

                }

                $count++;

                $query->$method($field, 'LIKE', "%{$search}%");

            }
        }

        return $query;
    }

    // Method for Eloquent Paginate Method
    public function scopePagination($query, $row_per_page = null)
    {
        $row_per_page = request()->row_per_page ?? 10;
    	return $query->paginate($row_per_page);
    }
}
