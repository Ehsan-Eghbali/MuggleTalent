<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Social extends Model
{
    /** @use HasFactory<\Database\Factories\SocialFactory> */
    use HasFactory;
    
    protected $fillable = [
        'employee_id',
        'telegram_id',
        'previous_experience',
        'sheba_check_control',
        'insurance_workshop',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(employees::class);
    }
}
