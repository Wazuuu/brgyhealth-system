<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_type',
        'file_path',
        'status',
        'data_json',
    ];

    protected $casts = [
        'data_json' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}