<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;

class ProductsController extends ApiController
{
     public function __construct()
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
        $this->middleware('auth:api')->except(['index', 'show']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     parent::__construct();
    //    // $this->middleware('transform.input:' . ProductTransformer::class)->only(['store','update']);
    // }
    public function index(Request $request)
    {
        // $perPage = $request->input('per_page') ?? 5;

        // $products = Products::paginate($perPage)->appends(
        //     [
        //         'per_page' => $perPage,
        //     ]
        // );
        // return response()->json($products, 200);

        $products = Products::all();

        return $this->showAll($products);

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        // return response()->json($product, 200);
        return $this->showOne($product);

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
