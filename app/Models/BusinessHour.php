<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'open_time',
        'close_time',
        'lunch_break_open',
        'lunch_break_close',
        'is_on',
    ];

    public function scopeActiveDay($query)
    {
        return $query->where('is_on', true);
    }
}
