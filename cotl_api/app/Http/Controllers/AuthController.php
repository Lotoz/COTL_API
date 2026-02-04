<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * AuthController
 * 
 * Handles user authentication operations including registration, login, and logout.
 * Manages user account creation, credential verification, and session management.
 * Uses Laravel Sanctum for API token-based authentication.
 */
class AuthController extends Controller
{
    /**
     * Register a new user account
     * 
     * Creates a new user with validated credentials and generates an API token.
     * The password must be confirmed (password confirmation field required).
     * 
     * @param Request $request Must contain: name, email, password, password_confirmation
     * @return \Illuminate\Http\JsonResponse Returns the created user and authentication token
     * @throws \Illuminate\Validation\ValidationException If validation fails
     */
    public function register(Request $request)
    {
        // Validate the incoming registration data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the new user in the database (password is auto-hashed by model)
        $user = User::create($validated);

        // Generate a Sanctum API token for the newly registered user
        $token = $user->createToken('api-token')->plainTextToken;

        // Return the user object and token with 201 Created status
        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    /**
     * Authenticate a user and generate an API token
     * 
     * Validates user credentials (email and password) and creates an authentication token
     * if the credentials are correct. Throws a validation exception if credentials are invalid.
     * 
     * @param Request $request Must contain: email, password
     * @return \Illuminate\Http\JsonResponse Returns the authenticated user and token
     * @throws \Illuminate\Validation\ValidationException If credentials are invalid
     */
    public function login(Request $request)
    {
        // Validate the incoming login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Find the user by email in the database
        $user = User::where('email', $request->email)->first();

        // Verify the user exists and password matches the hashed password
        if (! $user || ! Hash::check($request->password, $user->password)) {
            // Throw validation exception with custom error message
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        // Generate a Sanctum API token for the authenticated user
        $token = $user->createToken('api-token')->plainTextToken;

        // Return the user object and token
        return response()->json(['user' => $user, 'token' => $token]);
    }

    /**
     * Logout the authenticated user
     * 
     * Revokes all Sanctum API tokens for the authenticated user,
     * effectively ending all active sessions/connections.
     * 
     * @param Request $request The authenticated request object
     * @return \Illuminate\Http\JsonResponse Success message confirming logout
     */
    public function logout(Request $request)
    {
        // Revoke all API tokens for the authenticated user
        $request->user()->tokens()->delete();

        // Return success message
        return response()->json(['message' => 'Logged out successfully']);
    }
}
