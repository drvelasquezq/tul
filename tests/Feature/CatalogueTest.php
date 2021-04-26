<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CatalogueTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function list_a_catalog_of_products_with_conditions() {
        $this->withoutExceptionHandling();
        $parentCategoryActive = Category::create([
            'name' => 'Parent category active',
            'description' => 'This is a description',
            'status' => Category::ACTIVE,
            'category_id' => null
        ]);
        $parentCategoryInactive = Category::create([
            'name' => 'Parent category inactive',
            'description' => 'This is a description',
            'status' => Category::INACTIVE,
            'category_id' => null
        ]);
        $daugtherCategoryActive = Category::create([
            'name' => 'Daugther category active',
            'description' => 'This is a description',
            'status' => Category::ACTIVE,
            'category_id' => $parentCategoryActive->id
        ]);
        $daugtherCategoryInactive = Category::create([
            'name' => 'Daugther category inactive',
            'description' => 'This is a description',
            'status' => Category::INACTIVE,
            'category_id' => $parentCategoryInactive->id
        ]);
        $productCategoryDaugtherActive = Product::create([
            'image' => '',
            'sku' => 'ABCDEF23456-1',
            'name' => 'Name product',
            'description' => 'This is a description',
            'category_id' => $daugtherCategoryActive->id,
            'stock' => 40,
            'price' => 100.5
        ]);
        $productCategoryDaugtherActiveZeroStock = Product::create([
            'image' => '',
            'sku' => 'ABCDEF23456-4',
            'name' => 'Name product',
            'description' => 'This is a description',
            'category_id' => $daugtherCategoryActive->id,
            'stock' => 0,
            'price' => 100.5
        ]);
        $productCategoryDaugtherActiveZeroPrice = Product::create([
            'image' => '',
            'sku' => 'ABCDEF23456-2',
            'name' => 'Name product',
            'description' => 'This is a description',
            'category_id' => $daugtherCategoryActive->id,
            'stock' => 19,
            'price' => 0.0
        ]);
        $productCategoryDaugtherInactive = Product::create([
            'image' => '',
            'sku' => 'ABCDEF23456-3',
            'name' => 'Name product',
            'description' => 'This is a description',
            'category_id' => $daugtherCategoryInactive->id,
            'stock' => 40,
            'price' => 100.5
        ]);

        $response = $this->get('/catalogue');

        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

}
