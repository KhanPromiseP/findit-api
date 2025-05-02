<?php 

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $fields = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|confirmed',
            ]);

            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => Hash::make($fields['password']),
            ]);

            if ($user) {
                $token = $user->createToken('finditToken')->plainTextToken;

                return response()->json([
                    'status' => 'success',
                    'message' => 'User registered successfully',
                    'user' => $user,
                    'token' => $token
                ], 201);
            }

            return response()->json([
                'status' => 'fail',
                'message' => 'User registration failed'
            ], 500);

        } catch (\Exception $e) {
            Log::error('Register Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during registration',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $fields = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $fields['email'])->first();

            if (!$user || !Hash::check($fields['password'], $user->password)) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Invalid email or password'
                ], 401);
            }

            $token = $user->createToken('finditToken')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token
            ], 200);

        } catch (\Exception $e) {
            Log::error('Login Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during login',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {
                $user->tokens()->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged out successfully'
                ], 200);
            }

            return response()->json([
                'status' => 'fail',
                'message' => 'No authenticated user found'
            ], 401);

        } catch (\Exception $e) {
            Log::error('Logout Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during logout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
