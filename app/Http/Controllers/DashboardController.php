<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->hasRole('admin');
        if ($user) {
            return view('admin.dashboard');
        };
        return view('user.dashboard');
    }
}
