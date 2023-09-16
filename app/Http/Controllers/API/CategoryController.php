<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Helpers\ResponseApi;
use App\Models\CategoryModel;

//use ResponseApi;

class CategoryController extends Controller
{
    private ICategoryRepositoryInterface $categoryRepository;
    private $responseApi;

    public function __construct(ICategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->responseApi = new ResponseApi();
    }

    public function index()
    {
        try {

            $data = $this->categoryRepository->getAllCategories();

            if (count($data) > 0) {
                return $this->responseApi->success("All categories", $data);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function store(CategoryRequest $request)
    {
        try {

            $store = $this->categoryRepository->createCategory($request);

            if ($store) {
                return $this->responseApi->success("$request->name created", $store);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function show(string $id)
    {
        try {

            $category = $this->categoryRepository->getCategoryById($id);

            if ($category){
                return $this->responseApi->success("$category->name", $category);
            } else {
                return $this->responseApi->error("No Category with ID $id", 404);
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function update(CategoryRequest $request, string $id)
    {
        try {
            $update = $this->categoryRepository->updateCategory($request, $id);

            if ($update){
                return $this->responseApi->success("Category Updated", $update);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function destroy(string $id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }
}
