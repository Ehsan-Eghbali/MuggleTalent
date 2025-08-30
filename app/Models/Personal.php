<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Personal extends Model
{
    /** @use HasFactory<\Database\Factories\PersonalFactory> */
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'birth_date',
        'national_code',
        'father_name',
        'marital_status',
        'gender',
        'birth_place',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employees::class);
    }
}
