<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'scheduled_at',
        'reason',
        'status'
    ];

    // optional: relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
