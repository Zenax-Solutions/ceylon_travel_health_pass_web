<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DestinationBranchCodeCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the customer is already authenticated
        if ($request->session()->has('branch_code')) {
            // Redirect to dashboard if already authenticated
            if ($request->route()->getName() === 'destination.login') {
                return redirect()->route('destination.dashboard');
            }
        }


        return $next($request);
    }
}
