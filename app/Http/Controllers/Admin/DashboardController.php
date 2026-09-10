<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\Program;
use App\Models\Registration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = Registration::count();
        $totalPrograms = Program::count();
        $totalMentors = Mentor::count();

        return view('Admin.registration.dashboard', compact('totalPendaftar', 'totalPrograms', 'totalMentors'));
    }
}
