<?php

namespace App\Models;

use App\Scope\SellerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Seller extends User
{
    use HasFactory;

    protected $hidden =[
        'pivot',
        'password',
        'remember_token',
        'verification_token',
        'admin',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public static function boot(){
        parent::boot();
        // global scope
        static::addGlobalScope(new SellerScope);
    }
    public function products(){
        return $this->hasMany(Products::class);
    }
}
