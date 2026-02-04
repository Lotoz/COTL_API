<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowerController;

/**
 * API Routes for COTL (Cult of the Lamb)
 * 
 * This file defines all API endpoints for the application.
 * Routes are organized into two categories:
 * - Public routes: Available without authentication
 * - Protected routes: Require Sanctum authentication token
 */

// ============================================================================
// PUBLIC ROUTES - Authentication Endpoints
// ============================================================================
// These routes are accessible without requiring an authentication token
// Used for user registration and login operations

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ============================================================================
// PROTECTED ROUTES - Sanctum Authentication Required
// ============================================================================
// All routes within this group require a valid Sanctum authentication token
// The token is verified before allowing access to these endpoints 
Route::middleware('auth:sanctum')->group(function () {
    /**
     * GET /api/user
     * Retrieve the authenticated user's profile information
     * Returns the complete user object for the current authenticated session
     */
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /**
     * POST /api/logout
     * Terminate the authenticated user's session
     * Revokes the current Sanctum authentication token
     */
    Route::post('/logout', [AuthController::class, 'logout']);

    /**
     * API Resource Routes for Followers Management
     * 
     * Automatically generates RESTful endpoints:
     * - GET    /api/followers          - List all followers (index)
     * - POST   /api/followers          - Create new follower (store)
     * - GET    /api/followers/{id}     - Get specific follower (show)
     * - PATCH  /api/followers/{id}     - Update follower (update)
     * - DELETE /api/followers/{id}     - Delete follower (destroy)
     * 
     * All follower operations require authentication and user ownership verification
     */
    Route::apiResource('followers', FollowerController::class);
});
