<?php

namespace App\Repositories;

use App\Http\Requests\CategoryRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Models\CategoryModel;
use App\Traits\ResponseAPI;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements ICategoryRepositoryInterface
{
    use ResponseAPI;
    public function getAllCategories(): Collection
    {
        $categories = CategoryModel::all();
        return $categories;
//        try {
//            $categories = CategoryModel::all();
//            return $categories;
////            return $this->success("All Categories", $categories);
//
//        } catch (\Exception $e){
//            return $this->error($e->getMessage(), $e->getCode());
//        }
    }

    public function getCategoryById($categoryId)
    {
        return CategoryModel::find($categoryId);
    }

    public function createCategory($request)
    {
        $category = new CategoryModel();

        $category->name = $request->name;
        $category->save();

        if ($category->save()){
            return $category;
        } else {
            return null;
        }
    }

    public function updateCategory($request, $categoryId)
    {
        $category = CategoryModel::find($categoryId);

        if (!$category){
            return $this->error("No Category with ID $categoryId", 404);
        }

        $category->name = $request->name;
        $category->save();

        return $category;
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
