<?php

namespace App\Models;

use App\Scope\SellerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Seller extends User
{
    use HasFactory;

    public static function boot(){
        parent::boot();
        // global scope
        static::addGlobalScope(new SellerScope);
    }
    public function products(){
        return $this->hasMany(Products::class);
    }
}
