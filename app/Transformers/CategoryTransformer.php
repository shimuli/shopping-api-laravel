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
            'identifier'=> (int)$categories->id,
            'title'=> (string)$categories->name,
            'details'=> (string)$categories->description,
            'createdDate' => (string) $categories->created_at,
            'lastChange' => (string) $categories->updated_at,

        ];
    }
}
