<?php

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request The incoming HTTP request.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response indicating the registration status.
     */
    public function register(Request $request)
    {
        try {
            /**
             * Validate the incoming request data.
             *
             * @var array $fields An array containing the validated user registration data.
             */
            $fields = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|confirmed',
            ]);

            /**
             * Create a new user in the database.
             *
             * @var \App\Models\User $user The newly created user model instance.
             */
            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => Hash::make($fields['password']),
            ]);

            /**
             * Check if the user was created successfully.
             */
            if ($user) {
                /**
                 * Create a new API token for the registered user.
                 *
                 * @var string $token The plain text API token.
                 */
                $token = $user->createToken('finditToken')->plainTextToken;

                /**
                 * Return a success response with the user data and token.
                 */
                return response()->json([
                    'status' => 'success',
                    'message' => 'User registered successfully',
                    'user' => $user,
                    'token' => $token
                ], 201);
            }

            /**
             * Return a failure response if user registration failed.
             */
            return response()->json([
                'status' => 'fail',
                'message' => 'User registration failed'
            ], 500);

        } catch (\Exception $e) {
            /**
             * Log any exceptions that occur during the registration process.
             */
            Log::error('Register Error: ' . $e->getMessage());

            /**
             * Return an error response if an exception occurs.
             */
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during registration',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Log in an existing user.
     *
     * @param  \Illuminate\Http\Request  $request The incoming HTTP request.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response indicating the login status and user token.
     */
    public function login(Request $request)
    {
        try {
            /**
             * Validate the incoming request data for login.
             *
             * @var array $fields An array containing the validated user login credentials.
             */
            $fields = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            /**
             * Retrieve the user from the database based on the provided email.
             *
             * @var \App\Models\User|null $user The user model instance if found, otherwise null.
             */
            $user = User::where('email', $fields['email'])->first();

            /**
             * Check if the user exists and the provided password matches the stored hash.
             */
            if (!$user || !Hash::check($fields['password'], $user->password)) {
                /**
                 * Return an unauthorized response for invalid credentials.
                 */
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Invalid email or password'
                ], 401);
            }

            /**
             * Create a new API token for the authenticated user.
             *
             * @var string $token The plain text API token.
             */
            $token = $user->createToken('finditToken')->plainTextToken;

            /**
             * Return a success response with the user data and token upon successful login.
             */
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token
            ], 200);

        } catch (\Exception $e) {
            /**
             * Log any exceptions that occur during the login process.
             */
            Log::error('Login Error: ' . $e->getMessage());

            /**
             * Return an error response if an exception occurs during login.
             */
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during login',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Log out the currently authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request The incoming HTTP request containing user authentication information.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response indicating the logout status.
     */
    public function logout(Request $request)
    {
        try {
            /**
             * Get the currently authenticated user.
             */
            $user = $request->user();

            /**
             * Check if an authenticated user exists.
             */
            if ($user) {
                /**
                 * Revoke all of the user's current tokens.
                 */
                $user->tokens()->delete();

                /**
                 * Return a success response indicating successful logout.
                 */
                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged out successfully'
                ], 200);
            }

            /**
             * Return an unauthorized response if no authenticated user is found.
             */
            return response()->json([
                'status' => 'fail',
                'message' => 'No authenticated user found'
            ], 401);

        } catch (\Exception $e) {
            /**
             * Log any exceptions that occur during the logout process.
             */
            Log::error('Logout Error: ' . $e->getMessage());

            /**
             * Return an error response if an exception occurs during logout.
             */
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during logout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}