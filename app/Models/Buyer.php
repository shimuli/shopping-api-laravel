<?php

namespace App\Models;

use App\Scope\BuyerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buyer extends User
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BuyerScope);
    }

    protected $hidden=[
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

    // one buyer has many transaction relationship
    public function transactions(){
        return $this->hasMany(Transactions::class);
    }
}
