<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\ApiController;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(ShoppingCart::all());
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
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $shoppingCart)
    {
        return $this->showOne($shoppingCart);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCart $shoppingCart)
    {
        //
    }

    public function totals(ShoppingCart $shoppingCart) {
        $totalToPay = 0;
        $totalReferences = 0;
        $totalProducts = 0;

        $products = $shoppingCart->products;
        foreach($products as $product) {
            $totalToPay += $product->pivot->quantity * $product->price;
            $totalReferences += $product->pivot->quantity;
            $totalProducts++;
        }

        $data = [
            'totalToPay' => round($totalToPay, 2),
            'totalReferences' => $totalReferences,
            'totalProducts' => $totalProducts
        ];

        return $this->showAll(collect($data));
    }
}
