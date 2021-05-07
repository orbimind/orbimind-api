<?php

namespace App\QueryFilters;

use Kblais\QueryFilter\QueryFilter;
use Illuminate\Support\Facades\DB;

class PostsFilter extends QueryFilter
{
    public function search(string $value)
    {
        return $this->where('title', 'LIKE', '%' . $value . '%')->orWhere('content', 'LIKE', '%' . $value . '%');
    }

    public function user(string $value)
    {
        $id = DB::table('users')->where('username', $value)->first()->id;
        return $this->where('user_id', $id);
    }

    public function category(string $value)
    {
        $categories = explode(',', $value);
        $category_ids = array();
        try {
            for ($i = 0; $i < count($categories); $i++) {
                $id = DB::table('categories')->where('title', $categories[$i])->first()->id;
                array_push($category_ids, (int)$id);
            }
        } catch (\ErrorException $e) {
            return $this;
        }
        return $this->whereJsonContains('category_id', $category_ids);
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

    public function order(string $value)
    {
        $sort = explode('+', $value);
        switch ($sort[0]) {
            case 'date':
                return $this->orderBy('created_at', (string)$sort[1]);
            case 'date':
                return $this->orderBy('created_at', (string)$sort[1]);
            case 'rating':
                return $this;
        }
    }

    public function page()
    {
        return $this->paginate(10);
    }
}
