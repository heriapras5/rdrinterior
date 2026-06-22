<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$request->is('admin*') && !$request->is('_debugbar*') && !$request->ajax()) {
            try {
                PageView::create([
                    'page'       => $request->path(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'visited_at' => now(),
                ]);
            } catch (\Exception $e) {
                // silently fail
            }
        }

        return $response;
    }
}
