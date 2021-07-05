<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
     public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Products $product, User $buyer)
    {
        // our rules
        $rules=[
            'quantity'=> 'required|integer|min:1',
            'price'=> 'required|integer|min:1',
        ];

        // implement the rules
        $this-> validate($request, $rules);

        //seller is different from buyer
        //dd($product->seller_id);

        if ($buyer->id == $product->seller_id) {
            return $this->errorResponse('You cannot buy your own product', 409);
        }
        // buyer must be verified
        if (!$buyer->isVerified()) {
            return $this->errorResponse('This buyer is not verified', 409);
        }

        // seller must be verified
        if (!$product->seller->isVerified()) {
            return $this->errorResponse('This seller is not verified', 409);
        }

        // is the product available?
        if(!$product->isAvailable()){
            return $this->errorResponse('This product is not available', 409);

        }

        // do we have enough quantity?
        if($product->quantity < $request->quantity){
            return $this->errorResponse('This product does not have enough quantity to be sold', 409);
        }

        // ensure quantity and operation perform in a sequence
        return DB::transaction(function () use($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transactions::create([
                'quantity' =>$request->quantity,
                'price'=>$request->price,
                'buyer_id'=> $buyer->id,
                'product_id'=>$product->id
            ]);
            return $this->showOne($transaction, 201);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
}
