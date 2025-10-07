<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = [
        'personnel_id',
        'template_key',
        'number',
        'issued_at',
        'fields',
        'body_html',
        'status',
        'created_by',
    ];

    protected $casts = [
        'fields' => 'array',
        'issued_at' => 'date',
    ];

    public function attachments()
    {
        return $this->hasMany(LetterAttachment::class);
    }
}
