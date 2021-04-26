<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $mainCategory = null;
        $nullCategories = Category::all()->whereNull('category_id');

        if ($nullCategories->count() !== 0) {
            $mainCategory = $nullCategories->random()->id;
        }

        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(),
            'status' => $this->faker->randomElement([Category::ACTIVE, Category::INACTIVE]),
            'category_id' => $this->faker->randomElement([null, $mainCategory])
        ];
    }
}
