<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class military extends Model
{
    /** @use HasFactory<\Database\Factories\MilitaryFactory> */
    use HasFactory;
    protected $table = 'military';
public $timestamps = false;
    protected $primaryKey = null;    // یعنی کلید اصلی نداره
    public $incrementing = false;    // auto increment نکنه
    
    protected $fillable = [
        'employee_id',
        'military_status',
        'start_date',
        'end_date',
    ];
}
