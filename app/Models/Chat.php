<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /** @use HasFactory<\Database\Factories\ChatFactory> */
    use HasFactory;

    public $guarded = [];

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }
    
    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
