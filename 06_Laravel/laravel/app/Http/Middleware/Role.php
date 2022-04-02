<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class Role
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->user()->role == 'teacher') {
            return $next($request);
        }
        return redirect('/notperm');
    }
}
