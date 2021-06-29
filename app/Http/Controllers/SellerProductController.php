<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Seller $seller)
    {
        $perPage = $request->input('per_page') ?? 5;

        $product = $seller->products()->paginate($perPage)->appends(
            [
                'per_page' => $perPage,
            ]
        );
        //return $this->showAll($product);
        return response()->json(['product' => $product], 200);

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
    public function store(Request $request, User $seller)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['status'] = Products::UNAVAILABLE_PRODUCT;
        $data['image'] = '1.jpg';
        $data['seller_id'] = $seller->id;

        $product = Products::create($data);

        return $this->showOne($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller, Products $product)
    {
        $rules = [
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Products::AVAILABLE_PRODUCT . ',' . Products::UNAVAILABLE_PRODUCT,
            'image' => 'image',
        ];

        $this->validate($request, $rules);

        // check who is updating
        $this->checkSeller($seller, $product);

        $product->fill($request->only([
            'name',
            'description',
            'quantity',
        ]));

        if ($request->has('status')) {
            $product->status = $request->status;

            if ($product->isAvailable() && $product->categories()->count() == 0) {
                return $this->errorResponse("Status update failed, the product must be in a category", 409);
            }
        }
        if ($product->isClean()) {
            return $this->errorResponse('Select a product feature to update', 422);
        }

        $product->save();

        return $this->showOne($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, Products $product)
    {
        $this->checkSeller($seller, $product);

        $product->delete();
        return response()->json([
            "message" => 'Deleted Successfully', 'code' => '204',
        ], 200);

    }

    protected function checkSeller(Seller $seller, Products $product)
    {
        if ($seller->id != $product->seller_id) {
            throw new HttpException(422, "You are not authorize to perform this action on this specific product");
        }
    }
}
