<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable =[
        'quantity',
        'buyer_id',
        'product_id'

    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];


    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
    public function product(){
        return $this->belongsTo(Products::class);
    }
}
