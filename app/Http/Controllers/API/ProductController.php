<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Interfaces\IProductRepositoryInterface;

class ProductController extends Controller
{
    private IProductRepositoryInterface $productRepository;

    public function __construct(IProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return response()->json([
            'data' => $this->productRepository->getAllProducts()
        ]);
    }


    public function store(ProductRequest $request)
    {
        dd(2);
        return $this->productRepository->createProduct($request);
    }


    public function show(string $id)
    {
        return $this->productRepository->getProductById($id);
    }


    public function update(ProductRequest $request, string $id)
    {
        return $this->productRepository->updateProduct($request, $id);
    }


    public function destroy(string $id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}
