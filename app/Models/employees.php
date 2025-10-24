<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class employees extends Model
{
    use HasFactory;

    protected $table = 'employees'; // Explicitly defining the table name

    protected $fillable = [
        'employee_number',
        'first_name',
        'last_name',
        'full_name',
        'nickname',
        'position_chart',
        'team',
        'department',
        'direct_manager',
        'job_level',
        'contract_type',
        'work_status',
        'formality',
        'phone_number',
        'email',
        'organization_email',
        'gender',
    ];

    public function personal(): HasOne
    {
        return $this->hasOne(Personal::class, 'employee_id');
    }

    public function contract(): HasOne
    {
        return $this->hasOne(contract::class, 'employee_id');
    }

    public function insurance(): HasOne
    {
        return $this->hasOne(insurance::class, 'employee_id');
    }

    public function education(): HasOne
    {
        return $this->hasOne(education::class, 'employee_id');
    }

    public function military(): HasOne
    {
        return $this->hasOne(military::class, 'employee_id');
    }

    public function bankAccount(): HasOne
    {
        return $this->hasOne(BankAccount::class, 'employee_id');
    }

    public function ndaContract(): HasOne
    {
        return $this->hasOne(NdaContracts::class, 'employee_id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'employee_id');
    }

    public function contactInformation(): HasOne
    {
        return $this->hasOne(contract_information::class, 'employee_id');
    }

    public function social(): HasOne
    {
        return $this->hasOne(Social::class, 'employee_id');
    }

    public function payroll(): HasOne
    {
        return $this->hasOne(Payroll::class, 'employee_id');
    }
}
