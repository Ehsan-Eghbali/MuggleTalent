<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contract extends Model
{
    /** @use HasFactory<\Database\Factories\ContractFactory> */
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'contract_number',
        'trial_start_date',
        'exit_type',
        'exit_reason',
        'wants_insurance',
        'supplementary_insurance',
        'cooperation_status',
        'entry_date',
        'exit_date',
    ];
}
