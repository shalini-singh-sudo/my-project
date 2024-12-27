<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyApiKey
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
        $apiKey = $request->header('ApiKey');

        $expectedApiKey = env('API_KEY');
        
        if ($apiKey !== $expectedApiKey) {
            return response()->json(['success' => false, 'message' => 'Unauthorized: Invalid API Key'], 401);
        }

        // Continue to the next request
        return $next($request);
    }
}
