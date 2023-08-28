<?php

namespace App\Repositories;

use App\Interfaces\ICategoryRepositoryInterface;
use App\Models\CategoryModel;

class CategoryRepository implements ICategoryRepositoryInterface
{

    public function getAllCategories()
    {
        return CategoryModel::get();
    }

    public function getCategoryById($categoryId)
    {
        return CategoryModel::findOrFail($categoryId);
    }

    public function createCategory(array $categoryDetails)
    {
        return CategoryModel::create($categoryDetails);
    }

    public function updateCategory($categoryId, array $categoryDetails)
    {
        return CategoryModel::whereId($categoryId)->update($categoryDetails);
    }

    public function deleteCategory($categoryId)
    {
        return CategoryModel::destroy($categoryId);
    }
}
