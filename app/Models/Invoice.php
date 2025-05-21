<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'invoice_id',
        'file_path',
        'amount',
        'currency',
        'status',
    ];

    // Optional: define relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
