<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;

class DashboardController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function stats()
    {
        $total = Resident::count();
        $healthy = Resident::where('status','healthy')->count();
        $sick = Resident::where('status','sick')->count();
        $pregnantWomen = Resident::where('pregnant', true)->count();
        $male = Resident::where('gender','male')->count();
        $female = Resident::where('gender','female')->count();
        $children = Resident::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 18')->count();

        return response()->json([
            'totalResidents' => $total,
            'healthy' => $healthy,
            'sick' => $sick,
            'pregnantWomen' => $pregnantWomen,
            'male' => $male,
            'female' => $female,
            'children' => $children
        ]);
    }
}
