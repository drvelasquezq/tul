<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\Category;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait Validator {

    protected function validateStatusCategoryDaughterAndParentActiveOfProduct(Product $product) {
        $statusCategoryProduct = $product->category->status;

        if ((string) $statusCategoryProduct !== Category::ACTIVE) {
            $message = 'The status of the child category related to the product is inactive.';
            $message .= ' It is not possible to add to the shopping cart a product with the child category inactive.';
            throw new HttpException(422, $message);
        }

        $statusParentCategoryProduct = $product->category()
            ->with('category')
            ->get()
            ->pluck('category')
            ->first()
            ->status;

        if ((string) $statusCategoryProduct !== Category::ACTIVE) {
            $message = 'The status of the parent category related to the product is inactive.';
            $message .= ' It is not possible to add to the shopping cart a product with the parent category inactive.';
            throw new HttpException(422, $message);
        }
    }

    private function isADaugtherCategory(Category $category) {
        if (is_null($category->category)) {
            return false;
        }
        return true;
    }

    protected function validateThatTheStatusOfTheCategoryIsActive(Category $category) {
        if ((string) $category->status === Category::INACTIVE) {
            $message = 'The status of the category is inactive.';
            $message .= ' ' . ($this->isADaugtherCategory($category) ? 'Daugther category' : 'Partent category') . '.';
            throw new HttpException(422, $message);
        }
    }

    protected function validateThatItIsADaugtherCategory(Category $category) {
        if (is_null($category->category)) {
            $message = 'The category is not a daughter category.';
            throw new HttpException(422, $message);
        }
    }
}
