<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'address',
        'city',
        'pincode',
        'license_no',
        'mobile_no',
        'alternate_no',
        'date_of_birth',
        'gender',
        'type',
        'status',
    ];

    protected $dates = [
        'date_of_birth',
        'created_at',
        'updated_at',
    ];


}
