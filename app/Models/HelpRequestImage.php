<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpRequestImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'help_request_id',
        'image_path'
    ];

    public function helpRequest()
    {
        return $this->belongsTo(HelpRequest::class);
    }
}