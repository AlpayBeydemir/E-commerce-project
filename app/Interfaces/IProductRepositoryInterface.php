<?php

namespace App\Interfaces;

use App\Http\Requests\ProductRequest;
use App\Models\ProductModel;

interface IProductRepositoryInterface
{
    public function getAllProducts();

    public function getProductById($productId);

    public function getProductByCategory($categoryId);

    public function createProduct(ProductModel $product);

    public function updateProduct(ProductModel $product, int $productId);

    public function deleteProduct($productId);
}
