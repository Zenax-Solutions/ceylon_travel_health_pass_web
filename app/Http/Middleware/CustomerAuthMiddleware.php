<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the customer is already authenticated
        if ($request->session()->has('auth_customer')) {
            // Redirect to dashboard if already authenticated
            if ($request->route()->getName() === 'customer.login') {
                return redirect()->route('customer.dashboard');
            } elseif ($request->route()->getName() === 'customer.register') {
                return redirect()->route('customer.dashboard');
            }
        }



        // Proceed with the normal authentication flow
        return $next($request);
    }
}
