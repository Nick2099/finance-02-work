<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
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


    public function details()
    {
        return $this->hasOne(UserDetail::class);
    }

    /**
     * Accessor for created_at to convert it to the user's timezone.
     */
    public function getCreatedAtAttribute($value)
    {
        $timezone = $this->details->timezone ?? 'UTC'; // Get user's timezone or default to UTC
        return convertToUserTimezone($value, $timezone);
    }

    /**
     * Accessor for updated_at to convert it to the user's timezone.
     */
    public function getUpdatedAtAttribute($value)
    {
        $timezone = $this->details->timezone ?? 'UTC'; // Get user's timezone or default to UTC
        return convertToUserTimezone($value, $timezone);
    }
}
