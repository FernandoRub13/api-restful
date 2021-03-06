<?php

namespace App\Models;

use App\Transformers\UserTransformer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    // Table name
    protected $table = 'users';
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMINISTRATOR_USER = 'true';
    const REGULAR_USER = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $transformer = UserTransformer::class;

    public function isVerified()
    {
        return $this->verified === User::VERIFIED_USER;
    }

    public function isAdminisrator()
    {
        return $this->admin === User::ADMINISTRATOR_USER;
    }

    public static function generateVerificationToken()
    {
        return str_random(40);
    }


    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = strtolower($email);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    } 


}
