<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CookieAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $cookie = $request->cookie('user_consent');

        // $decoded = json_decode($cookie);

        // if (!$cookie || !$decoded || !isset($decoded->guid) || empty($decoded->guid)) {
        //     // If no valid consent cookie, redirect to a consent page or show a message
        //     return $next($request); // Adjust this to your consent page route
        // }

        return $next($request);
    }
}
