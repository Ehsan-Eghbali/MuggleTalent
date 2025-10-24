<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'level',
        'base_salary',
        'seniority',
        'housing',
        'marriage',
        'children',
        'responsibility',
        'food',
        'informal',
    ];

    protected $casts = [
        'base_salary' => 'decimal:2',
        'seniority' => 'decimal:2',
        'housing' => 'decimal:2',
        'marriage' => 'decimal:2',
        'children' => 'decimal:2',
        'responsibility' => 'decimal:2',
        'food' => 'decimal:2',
        'informal' => 'decimal:2',
    ];

    /**
     * Get the employee that owns the payroll
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(employees::class, 'employee_id');
    }

    /**
     * Get the history records for the payroll
     */
    public function history(): HasMany
    {
        return $this->hasMany(PayrollHistory::class, 'payroll_id');
    }
}
