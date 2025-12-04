<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    // Mass assignment is allowed for all fields except 'id'
    protected $guarded = ['id'];
    
    protected $casts = [
        'is_archived' => 'boolean', // <-- ADD THIS for the new column
    ];
}