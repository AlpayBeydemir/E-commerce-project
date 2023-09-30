<?php

namespace App\Interfaces;

use App\Models\CategoryModel;

interface ICategoryRepositoryInterface
{
    public function getAllCategories();

    public function getCategoryById($categoryId);

    public function createCategory(CategoryModel $category);

    public function updateCategory(CategoryModel $category, $categoryId);

    public function deleteCategory($categoryId);
}
