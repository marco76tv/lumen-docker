<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequests
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
        // Recupera l'URL della richiesta
        $url = $request->fullUrl();

        // Recupera il payload della richiesta se non è una GET
        $payload = $request->method() !== 'GET' ? $request->all() : null;

        // Scrive il log
        //Log::channel('access')->info('Request URL: ' . $url, ['payload' => $payload]);
        Log::info('Request URL: ' . $url, ['payload' => $payload]);

        return $next($request);
    }
}
