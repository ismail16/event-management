<?php

namespace App\Filters;

use Illuminate\Support\Facades\DB;

class UserFilter extends QueryFilters
{

    public function statusFilter($value)
    {
        return $this->builder->where('status', $value);
    }

    public function searchFilter($value)
    {
        return $this->builder->where(function($query) use($value) {
            $query->orWhere(DB::raw('LOWER(CONCAT(first_name, " ", last_name))'), 'LIKE', '%' . strtolower($value) . '%')
                ->orWhere('email', 'LIKE', strtolower($value) ."%'");
        });
    }

    public function rolesFilter($value)
    {
        return $this->builder->whereJsonContains('roles', $value);
    }

}
