<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user = DB::table('users')->insert([
            'id' => (string) \Str::uuid(),
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'=> $request->role,
        ]);

        return response()->json([
            'message' => 'User berhasil dibuat',
            'success' => true,
        ], 201);
    }


    public function login(Request $request){
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            
        ]);

        if(!$token = Auth::guard('api')->attempt($credentials)){
            return response()->json([
                'message' => 'Username atau password salah',
                'success' => false, 
            ], 401);
        }
        
        return response()->json([
            'message' => 'Anda berhasil login',
            'access_token' => $token,
            'token_type' => 'Bearer',
           'expires_in' => config('jwt.ttl') * 60,
           
        ]);
    }

    public function logout(){
        try{

            Auth::guard('api')->logout();
            
            return response()->json([
                'success'=> true,
                'message' => "Berhasil Logout"
                ], 200);
                }catch(\Exception $e){
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal Logout',
                    ], 401);
                }
    }

    public function get_login(){
        
    }


}