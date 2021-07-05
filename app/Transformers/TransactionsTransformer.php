<?php

namespace App\Transformers;

use App\Models\Transactions;
use League\Fractal\TransformerAbstract;

class TransactionsTransformer extends TransformerAbstract
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
    public function transform(Transactions $transactions)
    {
        return [
            'identifier'=> (int)$transactions->id,
            'quantity'=> (int)$transactions->quantity,
            'cost'=>(int)$transactions->price,
            'total_cost'=>(int)$transactions->price * (int)$transactions->quantity,
            'buyer'=> (int)$transactions->buyer_id,
            'product'=> (int)$transactions->product_id,
            'createdDate' => (string) $transactions->created_at,
            'lastChange' => (string) $transactions->updated_at,
        ];
    }
}
