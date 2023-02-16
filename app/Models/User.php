<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role');
    }

    public function authorizeRoles($roles)
    {
        if (is_array($roles))
        {
            return $this->hasAnyRole($roles) ||
            abort (401, 'This action is unathorized');
        }

        return $this->hasRole($roles) ||
        abort (401, 'This action is unathorized');
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    //links user to fish as a foreign key
    public function fishs()
    {
        return $this->hasMany((fish::class));
    }

    //links user to destination as a foreign key
    public function destinations()
    {
        return $this->hasMany((destination::class));
    }

    //links user to driver as a foreign key
    public function drivers()
    {
        return $this->hasMany((driver::class));
    }
}
