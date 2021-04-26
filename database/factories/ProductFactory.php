<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryDaughter = Category::all()->whereNotNull('category_id');
        $idCategoryDaughter = null;
        if ($categoryDaughter->count() !== 0) {
            $idCategorydaughter = $categoryDaughter->random()->id;
        }

        return [
            'image' => 'https://drvelasquez.s3.amazonaws.com/' . $this->faker->numberBetween(1, 20) . '.jpg',
            'sku' => $this->faker->unique()->regexify('[a-zA-Z0-9]{' . $this->faker->numberBetween(10, 40) . '}'),
            'name' => $this->faker->unique()->name,
            'description' => $this->faker->text(),
            'category_id' => $idCategorydaughter,
            'stock' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->randomFloat(2, 0, 100)
        ];
    }
}
