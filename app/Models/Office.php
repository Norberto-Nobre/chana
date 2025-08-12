<?php

// app/Models/Office.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'city',
        'phone',
        'email',
        'latitude',
        'longitude',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'decimal:8,6',
        'longitude' => 'decimal:9,6',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function pickupBookings()
    {
        return $this->hasMany(Booking::class, 'pickup_office_id');
    }

    public function returnBookings()
    {
        return $this->hasMany(Booking::class, 'return_office_id');
    }
}
