@extends('layouts.app')

@section('content')
<h1>Appointments List</h1>

@if($appointments->isEmpty())
    <p>No appointments yet.</p>
@else
<table border="1" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Date & Time</th>
        <th>Reason</th>
        <th>Status</th>
    </tr>
    @foreach($appointments as $app)
    <tr>
        <td>{{ $app->full_name }}</td>
        <td>{{ $app->email }}</td>
        <td>{{ $app->phone }}</td>
        <td>{{ $app->scheduled_at }}</td>
        <td>{{ $app->reason }}</td>
        <td>{{ ucfirst($app->status) }}</td>
    </tr>
    @endforeach
</table>
@endif
@endsection
