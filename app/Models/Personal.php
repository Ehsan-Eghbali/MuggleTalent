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
        'father_name',
        'mother_name',
        'national_code',
        'id_number',
        'id_serial',
        'birthplace',
        'id_issue_place',
        'birth_date_shamsi',
        'birth_date_real',
        'age',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
