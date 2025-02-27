<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;



class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {

        $username = $request->getUser();
        $password = $request->getPassword(); 

        if (!$username || !$password) {
            return response()->json(['message' => 'Unauthorized user'], 401, ['WWW-Authenticate' => 'Basic']);
        }

        $user = User::where('name', $username)->first();
        
        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'  ], 401, ['WWW-Authenticate' => 'Basic']);
        }

        Auth::login($user);

        return $next($request);
    }

}
