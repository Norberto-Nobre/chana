<?php
// app/Models/VehicleModel.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vehicle_models';

    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'year',
        'fuel_type',
        'transmission',
        'seats',
        'doors',
        'price_per_day',
        'image',
        'is_active'
    ];

    protected $casts = [
        'price_per_day' => 'decimal:2',
        'is_active' => 'boolean',
        'seats' => 'integer',
        'doors' => 'integer',
        'year' => 'integer',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
