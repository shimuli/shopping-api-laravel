<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends User
{
    use HasFactory;

    // one buyer has many transaction relationship
    public function transactions(){
        return $this->hasMany(Transactions::class);
    }
}
