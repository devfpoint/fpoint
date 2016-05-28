<?php

namespace App\Http\Controllers\CoachController;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function getHome()
    {
        return view('protected.coach.coach_dashboard');
    }

}