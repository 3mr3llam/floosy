<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class OpenCloseWebsite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
 
    
        if (Schema::hasTable('site_settings')) {

            $siteSetting = SiteSetting::latest()->first();

            // Check if the site is closed
            if ($siteSetting && $siteSetting->is_open == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('pages.site_closed'),
                    'data'=>[],
                ], 403);
            }
        }
        return $next($request);
    }
}
