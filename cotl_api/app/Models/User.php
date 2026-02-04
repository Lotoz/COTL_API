<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

/**
 * User Model
 * 
 * Represents a user in the COTL (Cult of the Lamb) application.
 * Extends Laravel's Authenticatable class to provide built-in authentication features.
 * 
 * Traits:
 * - HasApiTokens: Enables Sanctum API token authentication
 * - HasFactory: Provides factory methods for testing and database seeding
 * - Notifiable: Enables sending notifications to users via various channels
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable
     * These fields can be directly assigned during user creation or updates
     * 
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization
     * These sensitive attributes will not appear in JSON responses
     * 
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast
     * Defines how model attributes are transformed when accessed or set
     * 
     * - email_verified_at: Cast to datetime object for easy date manipulation
     * - password: Automatically hash the password using bcrypt when set
     * 
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all followers associated with this user
     * 
     * Establishes a one-to-many relationship between User and Follower models.
     * A single user can have multiple followers in their cult.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function followers()
    {
        return $this->hasMany(Follower::class);
    }
}
