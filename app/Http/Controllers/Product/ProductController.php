<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Product::all());
    }

}
