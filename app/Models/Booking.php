<?php

// app/Models/Booking.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'pickup_office_id',
        'return_office_id',
        'booking_code',
        'start_date',
        'end_date',
        'pickup_date',
        'return_date',
        'subtotal_amount',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'daily_rate',
        'days',
        'tax_percentage',
        'discount_percentage',
        'status',
        'notes'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'pickup_date' => 'datetime',
        'return_date' => 'datetime',
        'subtotal_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'daily_rate' => 'decimal:2',
        'days' => 'integer',
        'tax_percentage' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_ACTIVE = 'active';
    const STATUS_RETURNED = 'returned';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_EXPIRED = 'expired';

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pendente',
            self::STATUS_APPROVED => 'Aprovado',
            self::STATUS_ACTIVE => 'Ativo',
            self::STATUS_RETURNED => 'Devolvido',
            self::STATUS_CANCELLED => 'Cancelado',
            self::STATUS_EXPIRED => 'Expirado',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($booking) {
            $booking->booking_code = self::generateBookingCode();
        });
    }

    public static function generateBookingCode()
    {
        do {
            $code = 'RC' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('booking_code', $code)->exists());

        return $code;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function pickupOffice()
    {
        return $this->belongsTo(Office::class, 'pickup_office_id');
    }

    public function returnOffice()
    {
        return $this->belongsTo(Office::class, 'return_office_id');
    }

    public function contract()
    {
        return $this->hasOne(BookingContract::class);
    }

    public function documents()
    {
        return $this->hasMany(BookingDocument::class);
    }

    public function isExpired()
    {
        return $this->status === self::STATUS_APPROVED && 
               now()->isAfter($this->start_date->addHours(2)); // 2 horas de tolerância
    }
}
