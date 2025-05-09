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

        'is_approved',
        'approved_at',
        'approved_by'
    ];


      protected $casts = [
        'is_approved' => 'boolean',
        'approved_at' => 'datetime',
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


    //approval added
      public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }
}

