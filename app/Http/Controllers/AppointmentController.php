<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    // Show the form to create a new appointment
    public function createForm()
    {
        return view('appointments.create');
    }

    // Store the submitted appointment
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'scheduled_at' => 'required|date',
            'reason' => 'required|string',
        ]);

        if(auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        Appointment::create($data);

        return redirect('/')->with('success', 'Appointment request sent successfully!');
    }

    // List all appointments
    public function index()
    {
        $appointments = Appointment::latest()->get(); // or filter by user
        return view('appointments.index', compact('appointments'));
    }
}
