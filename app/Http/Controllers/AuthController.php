<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    public function register(request $request)
    {
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
    }

    public function login(request $request)
    {
        $credentials = request (['email', 'password']);

        if (!$token = Auth::attempt($credentials)){
            return response()->json(['error' => 'Usuário/Senha incorretos, verifique!'], 401);
        }
        return response()->json([
            'acess_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
    public function logout()
    {
        Auth::loggout();
        return response()->json(['message' => 'loggout efetuado com sucesso']);
    }
    public function index()
    {
        return Auth::user();
    }

}
