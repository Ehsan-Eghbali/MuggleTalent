<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class education extends Model
{
    /** @use HasFactory<\Database\Factories\EducationFactory> */
    use HasFactory;
    protected $table = 'educations';
    public $timestamps = false;
     protected $fillable = [
        'employee_id',
        'degree',
        'major',
        'university',
    ];
}
