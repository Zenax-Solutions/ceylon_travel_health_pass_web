<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgentAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the customer is already authenticated
        if ($request->session()->has('auth_agent')) {
            // Redirect to dashboard if already authenticated
            if ($request->route()->getName() === 'agent.login') {
                return redirect()->route('agent.dashboard');
            } elseif ($request->route()->getName() === 'agent.register') {
                return redirect()->route('agent.dashboard');
            }
        }

        return $next($request);
    }
}
