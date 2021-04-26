<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Models\Product;
use Aws\S3\Exception\S3Exception;
use Illuminate\Http\Request;

class CategoryProductController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $this->validateThatItIsADaugtherCategory($category);
        $this->validateThatTheStatusOfTheCategoryIsActive($category);
        $this->validateThatTheStatusOfTheCategoryIsActive($category->category);

        $rules = [
            'image' => 'required|image',
            'sku' => 'required|string|min:10|max:40|unique:products,sku',
            'name' => 'required|string|min:1',
            'description' => 'required|string|min:1',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ];

        $this->validate($request, $rules);

        try {
            $imageModulePath = env('AWS_URL', '') . '/' . $request->file('image')->store('images', 's3');
        } catch(S3Exception $S3Exception) {
            $imageModulePath = 'https://drvelasquez.s3.amazonaws.com/' . mt_rand(1, 20) . '.jpg';
        }

        $data = $request->all();
        $data['image'] = $imageModulePath;
        $data['category_id'] = $category->id;

        $product = Product::create($data);

        return $this->showOne($product);
    }
}
