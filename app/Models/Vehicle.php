<?php

// app/Models/Vehicle.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vehicle_model_id',
        'license_plate',
        'chassis_number',
        'color',
        'mileage',
        'status',
        'notes'
    ];

    protected $casts = [
        'mileage' => 'integer',
    ];

    const STATUS_AVAILABLE = 'available';
    const STATUS_RENTED = 'rented';
    const STATUS_MAINTENANCE = 'maintenance';
    const STATUS_INACTIVE = 'inactive';

    public static function getStatuses()
    {
        return [
            self::STATUS_AVAILABLE => 'Disponível',
            self::STATUS_RENTED => 'Alugado',
            self::STATUS_MAINTENANCE => 'Em Manutenção',
            self::STATUS_INACTIVE => 'Inativo'
        ];
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_model_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailable($startDate, $endDate)
    {
        if ($this->status !== self::STATUS_AVAILABLE) {
            return false;
        }

        return !$this->bookings()
            ->where('status', '!=', Booking::STATUS_CANCELLED)
            ->where('status', '!=', Booking::STATUS_RETURNED)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate])
                      ->orWhere(function ($q) use ($startDate, $endDate) {
                          $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                      });
            })->exists();
    }
}
