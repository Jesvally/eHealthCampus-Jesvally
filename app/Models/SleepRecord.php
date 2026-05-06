<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleepRecord extends Model
{
    use HasFactory;

   protected $fillable = [
    'user_id',
    'sleep_time',
    'wake_time',
    'date',
    ];


    protected $appends = ['duration'];

    public function getDurationAttribute()
    {
    if ($this->sleep_time && $this->wake_time) {
        $sleep = \Carbon\Carbon::parse($this->sleep_time);
        $wake  = \Carbon\Carbon::parse($this->wake_time);
        return $wake->diffInMinutes($sleep); // dalam menit
        }
    return 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}