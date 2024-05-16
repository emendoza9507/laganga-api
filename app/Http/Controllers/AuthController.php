<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;

class AuthController extends Controller implements HasMiddleware {
    public function login() {
        $credentials = request(['email', 'password']);

        if(! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        return $this->respondWithToken($token);

    }

    public function me() {
        return response()->json(auth()->user());
    }

    public function logout() {
        auth()->logout();


        return response()->json(['message' => 'Cierre de session expirado']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public static function middleware(): array
    {
        return [
            'api'
        ];
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
