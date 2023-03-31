<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        $user = Auth::user();

        if ($user) {
            if ($user->userType == $userType) {
                return $next($request);
            } else {
                return back()->with('error', 'Invalid user type.');
            }
        }
        return redirect('login');
    }
}
