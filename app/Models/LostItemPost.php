<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItemPost extends Model
{
    /** @use HasFactory<\Database\Factories\LostItemPostFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "user_id",
        "location",
        "description",
        "category_id",
        "status",
        "contact",
        "color",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function LostItemImages()
    {
        return $this->hasMany(LostItemPost::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
