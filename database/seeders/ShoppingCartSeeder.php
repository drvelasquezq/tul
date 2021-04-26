<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Database\Seeder;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantityShoppingCarts = 20;
        ShoppingCart::factory($quantityShoppingCarts)->create()->each(
            function ($shoppingCart) {

                $products = Product::select('products.id')
                    ->join('categories AS daughterCategories', 'products.category_id', '=', 'daughterCategories.id')
                    ->join('categories AS parentCategories', 'daughterCategories.category_id', '=', 'parentCategories.id')
                    ->where('daughterCategories.status', '=', Category::ACTIVE)
                    ->where('parentCategories.status', '=', Category::ACTIVE)
                    ->get()
                    ->random(mt_rand(1, 5))
                    ->pluck('id');

                $shoppingCart->products()->attach($products);
                $shoppingCart->products->each(
                    function ($product) {
                        $product->pivot->quantity = mt_rand(1, $product->stock);
                        $product->pivot->save();
                    }
                );
            }
        );
    }
}
