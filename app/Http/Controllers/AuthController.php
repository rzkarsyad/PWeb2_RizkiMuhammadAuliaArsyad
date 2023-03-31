<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function checkUserType()
    {
        // $userRole = Auth::user()->userType;
        // dd($userRole);
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        if (Auth::user()->userType === 'admin') {
            return redirect()->route('dashboard');
        }
        if (Auth::user()->userType === 'user') {
            return redirect()->route('user.dashboard');
        }
    }
}
