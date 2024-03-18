<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $table = 'tariff'; // Specify the table name if it's different from the model name
    protected $primaryKey = 'tariff_id'; // Specify the primary key if it's different

    protected $fillable = [
        'tariff_name',
        'tariff_type',
        'amount',
        'min_km',
        'per_km',
        'extra_km',
        'seat',
        'driver_charge',
        'expensive',
        'status',
    ];

    // If you want to automatically manage timestamps, you don't need to define these:
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s'; // If your database datetime format differs, you can specify it here
}
