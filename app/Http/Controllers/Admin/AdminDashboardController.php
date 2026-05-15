<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Career;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'assessments' => Assessment::count(),
            'careers' => Career::count(),
            'admins' => User::where('role', 'admin')->count(),
        ];

        $latestUsers = User::latest()->take(8)->get();
        return view('admin.dashboard', compact('stats', 'latestUsers'));
    }
}
