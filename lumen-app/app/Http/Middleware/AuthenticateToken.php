<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class AuthenticateToken
{
    /**
     * Gestisce una richiesta entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Skip authentication for GET requests
        if ($request->isMethod('get')) {
            return $next($request);
        }

        // Recupera il token dalla header Authorization
        $token = $request->bearerToken();

        // Verifica se il token è presente e valido
        if ($token !== 'YOUR_SECRET_TOKEN') {
            // Log dell'accesso negato
            //Log::channel('access')->warning('Unauthorized access attempt', ['url' => $request->fullUrl()]);
            Log::warning('Unauthorized access attempt', ['url' => $request->fullUrl()]);
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
