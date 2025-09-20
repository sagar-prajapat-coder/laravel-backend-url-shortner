<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();
        if(!$user || !$user->role || $user->role->name !== $role) {
            abort(403, 'Forbidden');
        }
        return $next($request);
    }
}
