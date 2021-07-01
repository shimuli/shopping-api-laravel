<?php

namespace App\Models;

use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

      public $transformer = CategoryTransformer::class;

    protected $fillable =[
        'name',
        'description',
    ];

    protected $hidden=[
        'created_at',
        'updated_at',
        'pivot'
    ];

    // many to many relationship
    public function products(){
        return $this->belongsToMany(Products::class);
    }

}
