<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollHistory extends Model
{
    use HasFactory;

    protected $table = 'payroll_history';

    protected $fillable = [
        'payroll_id',
        'employee_id',
        'user_id',
        'old_level',
        'old_base_salary',
        'old_seniority',
        'old_housing',
        'old_marriage',
        'old_children',
        'old_responsibility',
        'old_food',
        'old_informal',
        'new_level',
        'new_base_salary',
        'new_seniority',
        'new_housing',
        'new_marriage',
        'new_children',
        'new_responsibility',
        'new_food',
        'new_informal',
        'change_reason',
        'change_details',
    ];

    protected $casts = [
        'old_base_salary' => 'decimal:2',
        'old_seniority' => 'decimal:2',
        'old_housing' => 'decimal:2',
        'old_marriage' => 'decimal:2',
        'old_children' => 'decimal:2',
        'old_responsibility' => 'decimal:2',
        'old_food' => 'decimal:2',
        'old_informal' => 'decimal:2',
        'new_base_salary' => 'decimal:2',
        'new_seniority' => 'decimal:2',
        'new_housing' => 'decimal:2',
        'new_marriage' => 'decimal:2',
        'new_children' => 'decimal:2',
        'new_responsibility' => 'decimal:2',
        'new_food' => 'decimal:2',
        'new_informal' => 'decimal:2',
    ];

    /**
     * Get the payroll that owns the history
     */
    public function payroll(): BelongsTo
    {
        return $this->belongsTo(Payroll::class, 'payroll_id');
    }

    /**
     * Get the employee that owns the history
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(employees::class, 'employee_id');
    }

    /**
     * Get the user who made the change
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
