<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id', 
    'detak', 
    'tensi', 
    'status', 
    'notes'
];

    /**
     * Relasi ke model User.
     * Setiap rekam medis dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}