<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment; // <-- FIX: Use correct PascalCase Model name
use App\Models\User; // <-- Added User model import
use App\Notifications\NewAppointmentNotification; // <-- Added Notification import

class AppointmentController extends Controller
{
    public function index()
    {
        return view('appointments.index', [
            'appointments' => Appointment::all() // <-- FIX: Used correct model name
        ]);
    }

    public function create()
    {
        return view('appointments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'resident_id' => 'required|exists:residents,id',
            'appointment_date' => 'required|date',
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
        ]);

        $appointment = Appointment::create($validated); // <-- FIX: Used correct model name

        // -------------------------------------------------------------
        // FIX: Uncommented notification logic
        // Assumes that the `resident_id` is the same as the `user_id` for notification.
        // If the resident doesn't have a user account, this part will still need adjustment.
        // -------------------------------------------------------------
        $user = User::findOrFail($request->resident_id);
        $user->notify(new NewAppointmentNotification($appointment));

        return redirect()->route('appointments.index')->with('status', 'Appointment created successfully!');
    }

    // ... (rest of the class - other methods are implicitly fixed by the initial import)
}