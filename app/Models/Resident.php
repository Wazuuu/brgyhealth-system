<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Add all columns from the `residents` table (excluding id, timestamps).
     * Assuming columns like first_name, last_name, birth_date, address, phone_number, etc.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id']; // <-- FIX: Use $guarded to allow all but 'id'
    
    // Add relationships here if needed
}