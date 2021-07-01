<?php

namespace App\Transformers;

use App\Models\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
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
    public function transform(Buyer $buyer)
    {
        return [
            'identifier' => (int) $buyer->id,
            'name' => (string) $buyer->name,
            'tel' => (string) $buyer->phone,
            'isVerified' => (int) $buyer->verified,
            'createdDate' => (string) $buyer->created_at,
            'lastChange' => (string) $buyer->updated_at,
            'deletedDate' => $buyer->isset($buyer->deleted_at) ? (string) $buyer->deleted_at : null,
        ];
    }

     public static function originalAttributes($index){
        $attributes =[
             'identifier' => 'id',
            'name' => 'name',
            'tel' => 'phone',
            'isVerified' => 'verified',
            'createdDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at'
        ];
    }
}
