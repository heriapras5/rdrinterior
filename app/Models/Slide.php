<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slide extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'image', 'button_text', 'button_url',
        'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image
            ? (Str::startsWith($this->image, 'http') ? $this->image : asset('storage/' . $this->image))
            : 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=1600&q=80';
    }
}
