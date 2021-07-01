<?php

namespace App\Transformers;

use App\Models\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
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
    public function transform(Seller $seller)
    {
        return [
             'identifier' => (int) $seller->id,
            'name' => (string) $seller->name,
            'tel' => (string) $seller->phone,
            'isVerified' => (int) $seller->verified,
            'createdDate' => (string) $seller->created_at,
            'lastChange' => (string) $seller->updated_at,
            'deletedDate' => $seller->isset($seller->deleted_at) ? (string) $seller->deleted_at : null,
        ];
    }
}
