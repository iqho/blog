<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class IsAdminEditor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->user_type == 1 || auth()->user()->user_type == 2) {
            return $next($request);
        }

        return redirect('home')->with('error', "You don't have Admin/Editor access.");
    }
}
