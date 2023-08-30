<?php

namespace App\Interfaces;

use App\Http\Requests\CategoryRequest;

interface ICategoryRepositoryInterface
{
    public function getAllCategories();

    public function getCategoryById($categoryId);

    public function createCategory(CategoryRequest $request);

    public function updateCategory(CategoryRequest $request, $categoryId);

    public function deleteCategory($categoryId);
}
