<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Category $category)
    {
        $this->validateThatTheStatusOfTheCategoryIsActive($category);
        $this->validateThatTheStatusOfTheCategoryIsActive($category->category);
        $this->validateThatItIsADaugtherCategory($category);

        $rules = [
            'image' => 'required|image',
            'sku' => 'required|string|min:10|max:40|unique:products,sku',
            'name' => 'required|string|min:1',
            'description' => 'required|string|min:1',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ];

        $this->validate($request, $rules);

        $imageModulePath = env('AWS_URL', '') . '/' . $request->file('image')->store('images', 's3');

        $data = $request->all();
        $data['image'] = $imageModulePath;
        $data['category_id'] = $category->id;

        $product = Product::create($data);

        return $this->showOne($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
