<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FollowerController extends Controller
{
    // 1. LISTAR: Solo los seguidores del usuario autenticado
    public function index(Request $request)
    {
        return response()->json($request->user()->followers);
    }

    // 2. CREAR: Valida los 6 campos requeridos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:100', // Tipo 1: String
            'species'        => 'required|string|max:50',
            'level'          => 'required|integer|min:1',  // Tipo 2: Integer
            'loyalty_points' => 'required|integer|min:0',
            'is_elderly'     => 'required|boolean',        // Tipo 3: Boolean
            'joined_at'      => 'required|date',           // Tipo 4: Date
        ]);

        // Se asocia automáticamente al Lamb o Goat logueado
        $follower = $request->user()->followers()->create($validated);

        return response()->json($follower, 201);
    }

    // 3. MOSTRAR: Ver un seguidor específico
    public function show(Follower $follower)
    {
        $this->authorizeOwner($follower);
        return response()->json($follower);
    }

    // 4. ACTUALIZAR: Modificar datos del seguidor
    public function update(Request $request, Follower $follower)
    {
        $this->authorizeOwner($follower);

        $validated = $request->validate([
            'name'           => 'sometimes|string',
            'level'          => 'sometimes|integer',
            'is_elderly'     => 'sometimes|boolean',
            'loyalty_points' => 'sometimes|integer',
        ]);

        $follower->update($validated);
        return response()->json($follower);
    }

    // 5. ELIMINAR: Borrado directo (sin formularios POST)
    public function destroy(Follower $follower)
    {
        $this->authorizeOwner($follower);
        $follower->delete();

        return response()->json(['message' => 'Seguidor sacrificado con éxito']);
    }

    // Método de seguridad privado
    private function authorizeOwner(Follower $follower)
    {
        if ($follower->user_id !== auth()->id()) {
            abort(403, 'Este seguidor no pertenece a tu culto.');
        }
    }
}
