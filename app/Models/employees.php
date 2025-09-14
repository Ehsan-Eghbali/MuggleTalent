<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employees extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;
    protected $fillable = [
        'employee_number',
        'first_name',
        'last_name',
        'nickname',
        'full_name',
        'position',
        'team',
        'department',
        'manager',
        'job_level',
        'contract_type',
        'cooperation_status',
        'work_status',
        'formality',
        'phone_number',
        'email',
        'organization_email',
    ];

    public function personal(): HasOne
    {
        return $this->hasOne(Personal::class);
    }

    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class);
    }

    // بیمه
    public function insurance(): HasOne
    {
        return $this->hasOne(Insurance::class);
    }

    // تحصیلات
    public function education(): HasOne
    {
        return $this->hasOne(Education::class);
    }

    // وضعیت سربازی
    public function military(): HasOne
    {
        return $this->hasOne(Military::class);
    }

    // اطلاعات تماس
    public function contactInformation(): HasOne
    {
        return $this->hasOne(ContactInformation::class);
    }

    // اطلاعات اجتماعی (سوشال)
    public function social(): HasOne
    {
        return $this->hasOne(Social::class);
    }

    // حساب بانکی
    public function bankAccount(): HasOne
    {
        return $this->hasOne(BankAccount::class);
    }

    // قرارداد NDA
    public function ndaContract(): HasOne
    {
        return $this->hasOne(NdaContract::class);
    }

    // آدرس
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

}
