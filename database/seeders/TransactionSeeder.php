<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantityTransactions = 50;
        Transaction::factory($quantityTransactions)->create()->each(
            function ($transaction) {
                $products = Product::all()->random(mt_rand(1, 5))->pluck('id');
                $transaction->products()->attach($products);
                $transaction->products->each(
                    function ($product) {
                        $product->pivot->quantity = mt_rand(1, 100);
                        $product->pivot->save();
                    }
                );
            }
        );
    }
}
