<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function index(ShoppingCart $shoppingCart)
    {
        return $this->showAll($shoppingCart->products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ShoppingCart $shoppingCart, Product $product)
    {
        $rules = [
            'quantity' => 'required|min:1'
        ];

        $this->validate($request, $rules);
        $this->validateStatusCategoryDaughterAndParentActiveOfProduct($product);

        $isTheProductInTheShoppingCart = $this->isTheProductInTheShoppingCart($shoppingCart, $product);
        $quantityProductInShoppingCart = 0;
        if ($isTheProductInTheShoppingCart) {
            $productInShoppingCart = $this->getProductFromShoppingCart($shoppingCart, $product);
            $quantityProductInShoppingCart = $productInShoppingCart->pivot->quantity;
        }

        $quantityOfProductsOrdered = (integer) $request->quantity + $quantityProductInShoppingCart;
        $differenceQuantityRequestedStock = $product->stock - $quantityOfProductsOrdered;

        if ($differenceQuantityRequestedStock < 0) {
            $message = 'requested amount: ' . $request->quantity . ' + ';
            $message .= 'quantity in shopping cart: ' . $quantityProductInShoppingCart . ' - ';
            $message .= 'quantity in stock: ' . $product->stock . ' = ';
            $message .= $differenceQuantityRequestedStock;
            return $this->errorResponse($message, 422);
        }

        if ($isTheProductInTheShoppingCart) {
            $shoppingCart->products()->detach($product->id);
        }

        $shoppingCart->products()->attach($product->id, ['quantity' => $quantityOfProductsOrdered]);

        return redirect()->route('shopping-carts.products.index', ['shopping_cart' => $shoppingCart->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShoppingCart $shoppingCart, Product $product)
    {
        $rules = [
            'quantity' => 'required|min:1'
        ];

        $this->validate($request, $rules);
        $this->validateStatusCategoryDaughterAndParentActiveOfProduct($product);

        $isTheProductInTheShoppingCart = $this->isTheProductInTheShoppingCart($shoppingCart, $product);

        if (!$isTheProductInTheShoppingCart) {
            $message = 'The product is not related to the shopping cart.';
            $message .= ' Please add the product to the shopping cart.';
            return $this->errorResponse($message, 422);
        }

        $productInShoppingCart = $this->getProductFromShoppingCart($shoppingCart, $product);

        $quantityOfProductsOrdered = (integer) $request->quantity;
        $differenceQuantityRequestedStock = $product->stock - $quantityOfProductsOrdered;

        if ($differenceQuantityRequestedStock < 0) {
            $message = 'requested amount: ' . $request->quantity . ' - ';
            $message .= 'quantity in stock: ' . $product->stock . ' = ';
            $message .= $differenceQuantityRequestedStock;
            return $this->errorResponse($message, 422);
        }

        $shoppingCart->products()->detach($product->id);
        $shoppingCart->products()->attach($product->id, ['quantity' => $quantityOfProductsOrdered]);

        return redirect()->route('shopping-carts.products.index', ['shopping_cart' => $shoppingCart->id]);
    }

    private function isTheProductInTheShoppingCart(ShoppingCart $shoppingCart, Product $product)
    {
        $productInShoppingCart = $shoppingCart->products->where('id', '=', $product->id);
        $isTheProductInTheShoppingCart = false;
        if ($productInShoppingCart->count() > 0) {
            $isTheProductInTheShoppingCart = true;
        }
        return $isTheProductInTheShoppingCart;
    }

    private function getProductFromShoppingCart(ShoppingCart $shoppingCart, Product $product)
    {
        return $shoppingCart->products->where('id', '=', $product->id)->first();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCart $shoppingCart, Product $product)
    {
        $shoppingCart->products()->detach($product->id);
        return redirect()->route('shopping-carts.products.index', ['shopping_cart' => $shoppingCart->id]);
    }
}
