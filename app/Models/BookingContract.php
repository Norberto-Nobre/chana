<?php

// app/Models/BookingContract.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingContract extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'contract_number',
        'file_path',
        'generated_at',
        'terms_conditions'
    ];

    protected $casts = [
        'generated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($contract) {
            $contract->contract_number = self::generateContractNumber();
            $contract->generated_at = now();
        });
    }

    public static function generateContractNumber()
    {
        do {
            $number = 'CT' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('contract_number', $number)->exists());

        return $number;
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
