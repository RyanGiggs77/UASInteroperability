<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; 


class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        // Validate the incoming request data
        $this->validate($request, [
            'nama_pengguna'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        // Get all input data
        $input = $request->all();

        
        $validationRules = [
            'nama_pengguna' => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ];

        
        $validator = Validator::make($input, $validationRules);

        
        if ($validator->fails()) {

            return response()->json($validator->errors(), 400);
        
        }

        $user = new User;
        $user->nama_pengguna = $request->input('nama_pengguna');
        $user->email = $request->input('email');
        $user->peran = $request->input('peran');
        $plainPassword = $request->input('password');
        $user->password = app('hash')->make($plainPassword);

        $user->save();

        return response()->json($user, 200);
    }

    
    public function login(Request $request)
    {
        $input = $request->all();

        // Validation
        $validationRules = [
            'email' => 'required|string',
            'password' => 'required|string',
        ];

        $validator = Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Process login
        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ], 200);
    }
}