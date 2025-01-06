<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $roles = explode('|', $roles); // Mengubah string roles menjadi array
        if (!Auth::user()->hasAnyRole($roles)) {
            return redirect('/')->with('error', 'You do not have access.');
        }
        return $next($request);
    }

    protected $roles;

    public function __construct($roles)
    {
        $this->roles = $roles;
    }
}
