<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Interfaces\IProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private IProductRepositoryInterface $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function index()
    {
        return $this->productRepository->getAllProducts();
    }

    public function store(ProductRequest $request)
    {
        return $this->productRepository->createProduct($request);
    }

    public function show(string $id)
    {
        dd(212);
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

    public function categoryProduct($id)
    {
        return $this->productRepository->getProductByCategory($id);
    }
}
