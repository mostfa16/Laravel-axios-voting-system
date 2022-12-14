<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'role_id',
        'password',
        'ip_adresse',
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

    public static function maxi()
    {
        // return 55;
        return User::max('id')+1;
    }
    public function isAdmin()
    {
        // return $this->role_id ;:
        if ($this->role_id == '1') return true;
        return  false;
    }
    public function isManager()
    {
        if ($this->role_id == '0') return false;
        return true;
    }

    public function Ripcheck()
    {
        return $this->hasMany(Ripcheck::class);
    }

    public function Votes()
    {
        return $this->hasMany(Vote::class);
    }
    public static function RoleName($id)
    {
        if($id==0) return 'user';
        else if ($id==1) return 'Admin';
        return 'Manager';
    }
}
