<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model // <-- FIX: Renamed class to Appointment
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Add all columns from the `appointments` table (excluding id, timestamps).
     *
     * @var array<int, string>
     */
    protected $fillable = [ // <-- FIX: Added $fillable
        'resident_id', 
        'title', 
        'description', 
        'appointment_date', 
        'status'
    ]; 
    
    // Add relationships here if needed
    // public function resident() { return $this->belongsTo(Resident::class); }
}