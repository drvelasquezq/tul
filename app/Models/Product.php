<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ShoppigCart;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'sku',
        'name',
        'description',
        'category_id',
        'stock',
        'price'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function shoppingCarts() {
        return $this->belongsToMany(ShoppigCart::class);
    }

    public function transactions() {
        return $this->belongsToMany(Transaction::class);
    }
}
