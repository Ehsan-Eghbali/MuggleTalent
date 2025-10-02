<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NdaContracts extends Model
{
    /** @use HasFactory<\Database\Factories\NdaContractsFactory> */
    use HasFactory;
     protected $table = 'nda_contracts';
    protected $fillable = [
        'employee_id',
        'nda_type',
        'nda_start_date',
        'nda_end_date',
    ];
}
