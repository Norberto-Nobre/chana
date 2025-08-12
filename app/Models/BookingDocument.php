<?php

// app/Models/BookingDocument.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'document_type',
        'file_path',
        'original_name',
        'file_size',
        'uploaded_at'
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'file_size' => 'integer',
    ];

    const TYPE_ID = 'identity_document';
    const TYPE_PASSPORT = 'passport';
    const TYPE_LICENSE = 'driving_license';
    const TYPE_OTHER = 'other';

    public static function getTypes()
    {
        return [
            self::TYPE_ID => 'Bilhete de Identidade',
            self::TYPE_PASSPORT => 'Passaporte',
            self::TYPE_LICENSE => 'Carta de Condução',
            self::TYPE_OTHER => 'Outro'
        ];
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
