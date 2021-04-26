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
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $shoppingCart)
    {
        return $this->showOne($shoppingCart);
    }

    public function totals(ShoppingCart $shoppingCart)
    {
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
