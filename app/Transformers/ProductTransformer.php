<?php

namespace App\Transformers;

use App\Models\Products;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Products $products)
    {
        return [
            'identifier' => (int) $products->id,
            'title'=> (string)$products->name,
            'details'=> (string)$products->description,
            'stock' => (int) $products->quantity,
            'cost' => (int) $products->price,
            'status' => (string) $products->status,
            'picture' => url("img/{$products->image}"),
            'seller'=> (int)$products->seller_id,
            'createdDate' => (string) $products->created_at,
            'lastChange' => (string) $products->updated_at,
        ];
    }

     public static function originalAttributes($index){
        $attributes =[
             'identifier' =>'id',
            'title'=> 'name',
            'details'=>'description',
            'stock' => 'quantity',
            'cost'=> 'price',
            'status' => 'status',
            'picture' => 'image',
            'seller'=>'seller_id',
            'createdDate' => 'created_at',
            'lastChange' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

}
