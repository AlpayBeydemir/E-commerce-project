<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Interfaces\IProductRepositoryInterface;
use App\Models\ProductModel;
use App\Traits\ResponseAPI;

class ProductRepository implements IProductRepositoryInterface
{
    use ResponseAPI;

    public function getAllProducts()
    {
        try {
            $products = ProductModel::all();
            return $this->success("All Products", $products, 200);
        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getProductById($productId)
    {
        try {

            $product = ProductModel::findOrFail($productId);

            if (!$product){
                return $this->error("No Product with ID $productId", 404);
            }
            return $this->success("Product Detail", $product);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function createProduct(ProductRequest $request)
    {
        try {
            dd($request->all());
            $product = new ProductModel();

            $product->category_id = $request->category_id;
            $product->name        = $request->name;
            $product->price       = $request->price;
            $product->description = $request->description;

            $product->save();

            return $this->success("$product->name created", [
                'product' => $product,
            ]);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function updateProduct(ProductRequest $request, $productId)
    {
        try {

            $product = ProductModel::findOrFail($productId);

            if (!$product){
                return $this->error("No Product with ID $productId", 404);
            }

            $product->category_id = $request->category_id;
            $product->name        = $request->name;
            $product->price       = $request->price;
            $product->description = $request->description;

            $product->save();

            return $this->success("$product->name updated", [
                'product' => $product,
            ]);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function deleteProduct($productId)
    {
        try {

            $product = ProductModel::findOrFail($productId);

            if (!$product){
                return $this->error("No Product with ID $productId", 404);
            }

            $product->deleted = 1;

            $product->save();

            return $this->success("$product->name deleted", [
                'product' => $product,
            ]);

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
