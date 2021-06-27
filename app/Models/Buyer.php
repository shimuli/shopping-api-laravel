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

    // one buyer has many transaction relationship
    public function transactions(){
        return $this->hasMany(Transactions::class);
    }
}
