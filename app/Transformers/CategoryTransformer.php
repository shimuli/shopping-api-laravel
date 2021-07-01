<?php

namespace App\Transformers;

use App\Models\Categories;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
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
    public function transform(Categories $categories)
    {
        return [
            'identifier' => (int) $categories->id,
            'title' => (string) $categories->name,
            'details' => (string) $categories->description,
            'createdDate' => (string) $categories->created_at,
            'lastChange' => (string) $categories->updated_at,

            // HATEOAS

            'link' => [
                [
                    'rel' => 'self',
                    'href' => route('api.v1.categories.show', $categories->id),
                ],
                [
                    'rel' => 'categories.buyer',
                    'href' => route('api.v1.categories.buyer.index', $categories->id),
                ],

                [
                    'rel' => 'categories.products',
                    'href' => route('api.v1.categories.products.index', $categories->id),
                ],

                [
                    'rel' => 'categories.sellers',
                    'href' => route('api.v1.categories.sellers.index', $categories->id),
                ],

                [
                    'rel' => 'categories.transactions',
                    'href' => route('api.v1.categories.transactions.index', $categories->id),
                ],
            ],

        ];
    }

    public static function originalAttributes($index){
        $attributes =[
           'identifier' =>'id',
            'title' => 'name',
            'details' => 'description',
            'createdDate' => 'created_at',
            'lastChange' => 'updated_at',
        ];
    }
}
