<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * FollowerController handles all CRUD operations for followers
 * Manages creating, reading, updating, and deleting followers associated with users
 */
class FollowerController extends Controller
{

    /**
     * Retrieve all followers for the authenticated user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json($request->user()->followers);
    }


    /**
     * Create a new follower for the authenticated user
     * Validates required fields and creates the follower record
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming follower data
        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'species'        => 'required|string|max:50',
            'level'          => 'required|integer|min:1',
            'loyalty_points' => 'required|integer|min:0',
            'is_elderly'     => 'required|boolean',
            'joined_at'      => 'required|date',
        ]);

        // Create the follower and associate it with the authenticated user
        $follower = $request->user()->followers()->create($validated);

        return response()->json($follower, 201);
    }

    /**
     * Retrieve a specific follower by ID
     * Verifies that the authenticated user owns the follower
     *
     * @param Follower $follower
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Follower $follower)
    {
        // Verify user authorization before returning follower data
        $this->authorizeOwner($follower);
        return response()->json($follower);
    }

    /**
     * Update a specific follower's data
     * Allows partial updates of follower attributes
     *
     * @param Request $request
     * @param Follower $follower
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Follower $follower)
    {
        // Verify user authorization before allowing updates
        $this->authorizeOwner($follower);

        // Validate the incoming update data (all fields are optional)
        $validated = $request->validate([
            'name'           => 'sometimes|string',
            'level'          => 'sometimes|integer',
            'is_elderly'     => 'sometimes|boolean',
            'loyalty_points' => 'sometimes|integer',
        ]);

        // Apply the validated changes to the follower
        $follower->update($validated);
        return response()->json($follower);
    }

    /**
     * Delete a follower
     * Removes the follower record from the database
     *
     * @param Follower $follower
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Follower $follower)
    {
        // Verify user authorization before allowing deletion
        $this->authorizeOwner($follower);

        // Delete the follower record
        $follower->delete();

        return response()->json(['message' => 'Seguidor sacrificado con éxito']);
    }

    /**
     * Verify that the authenticated user owns the follower
     * Prevents users from accessing or modifying other users' followers
     *
     * @param Follower $follower
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    private function authorizeOwner(Follower $follower)
    {
        // Check if the follower belongs to the authenticated user
        if ($follower->user_id !== auth()->id()) {
            abort(403, 'Este seguidor no pertenece a tu culto.');
        }
    }
}
