<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LetterAttachment extends Model
{
    protected $fillable = [
        'letter_id',
        'original_name',
        'disk',
        'path',
        'mime',
        'size',
        'uploaded_by',
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }

    public function existsOnDisk(): bool
    {
        return Storage::disk($this->disk)->exists($this->path);
    }
}
