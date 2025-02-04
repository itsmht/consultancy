<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiUser;

class AuthHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $username = $request->header('username');
        $password = $request->header('password');

        if (!$username || !$password) {
            return response()->json(['code'=>'400','message'=>'Username and password are required','data'=>null], 400);
        }

        // Fetch the user from the database
        $user = ApiUser::where('username', $username)->where('password', $password)->first();

        if (!$user) {
            return response()->json(['code'=>'401','message'=>'Wrong Credentials','data'=>null], 401);
        }

        // Optionally attach the user to the request for further use
        $request->merge(['authenticated_user' => $user]);

        return $next($request);
    }
}
