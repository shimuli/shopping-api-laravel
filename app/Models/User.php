<?php

namespace App\Models;

use App\Transformers\UserTransformer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const VERIFIED_USER ='1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER ='true';
    const REGULAR_USER = 'false';

    public $transformer = UserTransformer::class;
    protected $table = 'users';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        //'last_name',
        'email',
        'phone',
        'password',
        'verified',
        'verification_token',
        'admin',
        'pivot'
    ];

    // name setters and getters
    public function setUserNameAttribute($name){
        $this->attributes['user_name'] = strtolower($name);
    }

     public function getUserNameAttribute($name){
        return ucwords($name);
    }

    // email setters
    public function setEmailAttribute($email){
        $this->attributes['email'] = strtolower($email);
    }

    public function isVerified(){
        return $this->verified ==User::VERIFIED_USER;
    }

    public function isAdmin(){
        return $this->admin ==User::ADMIN_USER;
    }

    public static function generateVerificationCode(){
        //return Str::random(40);
        return Str::random(40);
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
        'admin',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
