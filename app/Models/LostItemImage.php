<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItemImage extends Model
{
    /** @use HasFactory<\Database\Factories\LostItemImageFactory> */
    use HasFactory;

    protected $fillable = [
        "image_path",
        "lost_item_post_id"
    ];

    public function LostItemPost(){
        return $this->belongsTo(LostItemPost::class);
    }
}
