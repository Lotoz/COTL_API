<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'species',
        'level',
        'loyalty_points',
        'is_elderly',
        'joined_at'
    ];

    /**
     * Casting de atributos.
     * Esto asegura que Laravel trate 'is_elderly' como true/false 
     * y 'joined_at' como un objeto Carbon (fecha) automáticamente.
     */
    protected $casts = [
        'is_elderly' => 'boolean',
        'joined_at' => 'date',
        'level' => 'integer',
        'loyalty_points' => 'integer',
    ];

    /**
     * Relación inversa: Un seguidor pertenece a un usuario (Cordero/Cabra).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
