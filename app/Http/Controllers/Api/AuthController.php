<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
             $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_path' => 'string' //fix this
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile_path' => request('profile_path') //fix this
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'user' => $user->makeHidden(['password']), 
        ], 201);
         
     }
        

      public function profile(Request $request)
    {
    
            return response()->json([
                'status' => 'success',
                'user' => $request->user()
            ], 205);       
    }

   public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'user' => Auth::user(),
                'message' => 'Logged in'
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    public function logoutt()
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out']);
    }

 
    public function user()
    {
        return response()->json([
            'user' => Auth::user()
        ]);
    }

}





