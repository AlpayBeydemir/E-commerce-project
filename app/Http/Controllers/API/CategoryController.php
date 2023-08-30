<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Interfaces\ICategoryRepositoryInterface;

class CategoryController extends Controller
{
    private ICategoryRepositoryInterface $categoryRepository;

    public function __construct(ICategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        return response()->json([
            'data' => $this->categoryRepository->getAllCategories()
        ]);
    }

    public function store(CategoryRequest $request)
    {
        return $this->categoryRepository->createCategory($request);
    }

    public function show(string $id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    public function update(CategoryRequest $request, string $id)
    {
        return $this->categoryRepository->updateCategory($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }
}
