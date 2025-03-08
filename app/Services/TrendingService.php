<?php

namespace App\Services;

use App\Tags;

class TrendingService
{
    public function tags()
    {
        return Tags::limit(5)
            ->orderBy('tags_count', 'desc')
            ->get();
    }
}
