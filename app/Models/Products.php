<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
     const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $fillable=[
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id'
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];

    public function categories(){
       return $this->belongsToMany(Categories::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function transactions(){
        return $this->hasMany(Transactions::class);
    }


    // if product is available or not
    public function isAvailable(){
        return $this->status == Products::AVAILABLE_PRODUCT;
    }
}
