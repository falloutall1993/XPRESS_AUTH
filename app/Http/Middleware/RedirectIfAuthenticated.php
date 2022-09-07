<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class RedirectIfAuthenticated
{
    // Blocked IP addresses
    public $restrictedIp = [ '202.173.125.72', '192.168.0.3', '202.173.125.71'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (in_array($request->ip(), $this->restrictedIp)) {
            return response()->json(['message' => "You are not allowed to access this site."]);
        }
        return $next($request);
    }     
}