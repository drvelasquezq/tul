<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Models\Transaction;
use App\Models\Shoppingcart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class ShoppingCartTransactionController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shoppingcart $shoppingCart)
    {
        return DB::transaction(function () use ($shoppingCart) {
            $transaction = Transaction::create();

            $productsInShoppingCart = $shoppingCart->products;
            foreach($productsInShoppingCart as $productInShoppingCart) {
                $quantity = $productInShoppingCart->pivot->quantity;
                $transaction->products()->attach($productInShoppingCart->id, ['quantity' => $quantity]);
                $shoppingCart->products()->detach($productInShoppingCart->id);
                $productInShoppingCart->stock -= $quantity;
                $productInShoppingCart->save();
            }

            return $this->showAll($transaction->products);
        });
    }
}
