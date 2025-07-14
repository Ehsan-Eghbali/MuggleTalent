<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;
    protected $fillable = [
        'employee_number',
        'first_name',
        'last_name',
        'full_name',
        'position',
        'team',
        'department',
        'manager',
        'job_level',
        'contract_type',
        'work_status',
        'formality',
        'phone_number',
        'email',
        'organization_email',
    ];


}
