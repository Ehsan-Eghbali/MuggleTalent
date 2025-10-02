<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class insurance extends Model
{
    /** @use HasFactory<\Database\Factories\InsuranceFactory> */
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'insurance_position',
        'insurance_code',
        'insurance_number',
        'has_dependents',
    ];
}
