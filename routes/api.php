<?php
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard-stats', function () {
    $totalResidents = Resident::count();
    $healthy = Resident::where('status', 'healthy')->count();
    $sick = Resident::where('status', 'sick')->count();
    $pregnantWomen = Resident::where('pregnant', true)->count();
    $male = Resident::where('gender', 'male')->count();
    $female = Resident::where('gender', 'female')->count();
    $children = Resident::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 18')->count();

    return response()->json([
        'totalResidents' => $totalResidents,
        'healthy' => $healthy,
        'sick' => $sick,
        'pregnantWomen' => $pregnantWomen,
        'male' => $male,
        'female' => $female,
        'children' => $children
    ]);
});
