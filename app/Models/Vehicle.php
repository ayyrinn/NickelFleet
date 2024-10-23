<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'plate_number',
        'fuel_type',
        'is_rented',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
