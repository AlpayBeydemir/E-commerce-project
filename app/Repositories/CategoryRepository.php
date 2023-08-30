<?php

namespace App\Repositories;

use App\Http\Requests\CategoryRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Models\CategoryModel;
use App\Traits\ResponseAPI;

class CategoryRepository implements ICategoryRepositoryInterface
{
    use ResponseAPI;
    public function getAllCategories()
    {
        try {
            $categories = CategoryModel::all();
            return $this->success("All Categories", $categories);
        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getCategoryById($categoryId)
    {
        try {
            $category = CategoryModel::findOrFail($categoryId);

            if (!$categoryId){
                return $this->error("No Category with ID $categoryId", 404);
            }

            return $this->success("Category Detail", $category);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function createCategory(CategoryRequest $request)
    {
        try {

            $category = new CategoryModel();

            $category->name = $request->name;
            $category->save();

            return $this->success("$category->name created", [
                'category' => $category,
            ]);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function updateCategory(CategoryRequest $request,$categoryId)
    {
        try {

            $category = CategoryModel::findOrFail($categoryId);

            if (!$categoryId){
                return $this->error("No Category with ID $categoryId", 404);
            }

            $category->name = $request->name;
            $category->save();

            return $this->success("$category->name updated", [
                'category' => $category,
            ]);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function deleteCategory($categoryId)
    {
        try {

            $category = CategoryModel::findOrFail($categoryId);

            if (!$categoryId){
                return $this->error("No Category with ID $categoryId", 404);
            }

            $category->delete();

            return $this->success("Category Deleted", $category);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
