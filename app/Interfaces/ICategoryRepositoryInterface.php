<?php

namespace App\Interfaces;

interface ICategoryRepositoryInterface
{
    public function getAllCategories();

    public function getCategoryById($categoryId);

    public function createCategory(array $categoryDetails);

    public function updateCategory($categoryId, array $categoryDetails);

    public function deleteCategory($categoryId);
}
