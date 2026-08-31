<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{
    protected $fillable = ['title', 'description', 'image_path', 'category', 'event_date', 'location', 'order', 'is_featured', 'is_active'];

    protected $casts = ['is_featured' => 'boolean', 'is_active' => 'boolean', 'event_date' => 'date'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }
}
