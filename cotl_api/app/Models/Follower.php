<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Follower Model
 * 
 * Represents a follower/disciple in a user's cult.
 * Each follower is associated with a user and contains attributes like name, species, level, and loyalty points.
 */
class Follower extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     * These fields can be directly assigned during follower creation or updates
     * 
     * @var array<int, string>
     */
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
     * Get the attributes that should be cast
     * Defines how model attributes are transformed when accessed or set
     * 
     * - is_elderly: Cast to boolean for proper true/false type handling
     * - joined_at: Cast to date object (Carbon instance) for date manipulation
     * - level: Cast to integer for numeric operations
     * - loyalty_points: Cast to integer for numeric operations
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'is_elderly' => 'boolean',
        'joined_at' => 'date',
        'level' => 'integer',
        'loyalty_points' => 'integer',
    ];

    /**
     * Get the user that owns this follower
     * 
     * Establishes an inverse one-to-many relationship with the User model.
     * Each follower belongs to exactly one user (the cult leader).
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
