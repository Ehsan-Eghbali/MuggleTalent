<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'home_address',
        'postal_code',
        'home_phone',
        'emergency_phone',
        'emergency_contact_info',
    ];
}
