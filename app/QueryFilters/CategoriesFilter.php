<?php

namespace App\QueryFilters;

use Kblais\QueryFilter\QueryFilter;

class CategoriesFilter extends QueryFilter
{
    public function search(string $value)
    {
        return $this->where('title', 'LIKE', '%' . $value . '%');
    }
}
