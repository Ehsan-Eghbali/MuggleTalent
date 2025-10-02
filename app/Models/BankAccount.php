<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    /** @use HasFactory<\Database\Factories\BankAccountFactory> */
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'pasargad_account_number',
        'pasargad_sheba',
        'pasargad_card',
        'pasargad_branch',
        'bank_type',
        'bank_branch_name',
        'account_number',
        'sheba_number',
        'card_number',
    ];
}
