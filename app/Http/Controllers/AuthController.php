<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Login méthode pour la connsxion
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            "email" => ['required', 'email', 'string'],
            "password" => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }
        $credentials = $request->only(["email", "password"]);
        $token = auth()->attempt($credentials);
        if (!$token) {
            return response()->json(["message" => "Informations de connexion incorrectes"], 401);
        }
        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
            "user" => auth()->user(),
            "expires_in" => env("JWT_TTL") * 60 . " seconds"
        ]);

    }

    // logout méthode pour la déconnsxion
    public function logout()
    {
        auth()->logout();
        return response()->json(["message" => "Déconnexion réussie"]);
    }

    // refresh méthode pour le rafraichiseement
    public function refresh()
    {
        $token = auth()->refresh();
        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
            "user" => auth()->user(),
            "expires_in" => env("JWT_TTL") * 60 . " seconds"
        ]);
    }

}
