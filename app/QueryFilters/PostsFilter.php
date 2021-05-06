<?php

namespace App\QueryFilters;

use Kblais\QueryFilter\QueryFilter;

class PostsFilter extends QueryFilter
{
    public function title(string $value)
    {
        return $this->where('title', 'like', '%' . $value . '%');
    }

    public function content(string $value)
    {
        return $this->where('content', 'like', '%' . $value . '%');
    }

    public function user(int $value)
    {
        return $this->where('user_id', $value);
    }

    public function category(int $value)
    {
        return $this->whereJsonContains('category_id', $value);
    }

    public function status(bool $value)
    {
        return $this->where('status', $value);
    }

    public function startDate($start)
    {
        return $this->where('created_at', '>=', $start);
    }
    public function endDate($end)
    {
        return $this->where('created_at', '<', $end . ' 23:59:59');
    }
}
