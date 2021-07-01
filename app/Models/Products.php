<?php

namespace App\Models;

use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
     const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

      public $transformer = ProductTransformer::class;

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
        'updated_at',
        'pivot',
    ];

    public function categories(){
       return $this->belongsToMany(Categories::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function transactions(){
        return $this->hasMany(Transactions::class, 'product_id');
    }


    // if product is available or not
    public function isAvailable(){
        return $this->status == Products::AVAILABLE_PRODUCT;
    }
}
