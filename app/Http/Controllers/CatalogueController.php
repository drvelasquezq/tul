<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Category;

class CatalogueController extends ApiController
{
    public function index() {
        $products = Product::whereHas('category', function ($daugtherCategory) {
            $daugtherCategory->whereHas('category', function($parentCategory) {
                $parentCategory->where('status', '=', Category::ACTIVE);
            })->where('status', '=', Category::ACTIVE);
        })
        ->where('stock', '>', '0')
        ->where('price', '>', '0')
        ->get();

        return $this->showAll($products);
    }
}
