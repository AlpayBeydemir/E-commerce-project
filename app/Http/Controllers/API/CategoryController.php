<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\ICategoryRepositoryInterface;
use Illuminate\Http\Request;

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


    public function store(Request $request)
    {
        return $this->categoryRepository->createCategory();
    }


    public function show(string $id)
    {
        return $this->categoryRepository->getCategoryById();
    }


    public function update(Request $request, string $id)
    {
        return $this->categoryRepository->updateCategory($id, $request);
    }


    public function destroy(string $id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }
}
