@extends('layouts.app')

@section('content')
<h1>Make an Appointment</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('appointments.store') }}">
    @csrf

    <label>Full Name</label><br>
    <input type="text" name="full_name" value="{{ old('full_name') }}" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Phone Number</label><br>
    <input type="text" name="phone" value="{{ old('phone') }}" required><br><br>

    <label>Preferred Date & Time</label><br>
    <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}" required><br><br>

    <label>Reason for Appointment</label><br>
    <textarea name="reason" required>{{ old('reason') }}</textarea><br><br>

    <button type="submit">Submit Appointment</button>
</form>
@endsection
