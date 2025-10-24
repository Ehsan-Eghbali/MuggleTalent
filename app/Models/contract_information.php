<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class contract_information extends Model
{
    /** @use HasFactory<\Database\Factories\ContractInformationFactory> */
    use HasFactory;
    
    protected $table = 'contact_information';
    
    protected $fillable = [
        'employee_id',
        'address',
        'postal_code',
        'emergency_contact',
        'emergency_contact_info',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(employees::class);
    }
}
