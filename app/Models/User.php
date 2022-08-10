<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_USER = 'ROLE_USER';

    public const ROLE_ADMIN = 'ROLE_ADMIN';

    public const ADMIN_EMAIL = 'admin@admin';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'roles' => '["' . self::ROLE_USER . '"]'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'roles',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles' => 'array',
        'created_at' => 'datetime:d.m.Y в H:i:s',
        'updated_at' => 'datetime:d.m.Y в H:i:s',
    ];

    /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the comments for the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * User has Role?
     */
    public function hasRole($role)
    {
        return in_array($role, $this->roles);
    }

    /**
     * User is Administrator?
     */
    public function isAdmin()
    {
        return in_array(self::ROLE_ADMIN, $this->roles);
    }

    /**
     * Get the roles a user has.
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function roles()
    {
        return Attribute::make(
            get: fn ($value) => (array_merge($value, [self::ROLE_USER])),
            set: fn ($value) => (array_merge($value, [self::ROLE_USER]))
        );
    }

    /**
     * Get the user's created time.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d.m.Y в H:i:s', strtotime($value)),
        );
    }

    /**
     * Get the user's updated time.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d.m.Y в H:i:s', strtotime($value)),
        );
    }
}
