<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = ['page', 'ip_address', 'user_agent', 'visited_at'];

    protected function casts(): array
    {
        return ['visited_at' => 'datetime'];
    }
}
