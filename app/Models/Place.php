<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location', 'image', 'category', 'rating', 'visitors', 'video_path', 'video_url', 'ticket_price', 'opening_hours', 'maps_url'];

    public function photos()
    {
        return $this->hasMany(PlacePhoto::class);
    }

    public function comments()
    {
        return $this->hasMany(PlaceComment::class);
    }
}
