<?php

namespace App\Interfaces;

use App\Http\Requests\ProductRequest;

interface IProductRepositoryInterface
{
    public function getAllProducts();

    public function getProductById($productId);

    public function getProductByCategory($categoryId);

    public function createProduct(ProductRequest $request);

    public function updateProduct(ProductRequest $request, $productId);

    public function deleteProduct($productId);
}
