<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Interfaces\IProductRepositoryInterface;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements IProductRepositoryInterface
{
    use ResponseAPI;

    public function getAllProducts()
    {
        return ProductModel::all();
    }

    public function getProductById($productId)
    {
        return ProductModel::find($productId);
    }

    public function createProduct($request)
    {
        $product = new ProductModel();

        $product->category_id = $request->category_id;
        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->description = $request->description;

        $product->save();

        if ($product->save()){
            return $product;
        } else {
            return null;
        }
    }

    public function updateProduct($request, $productId)
    {
        $product = ProductModel::findOrFail($productId);

        if (!$product){
            return $this->error("No Product with ID $productId", 404);
        }

        $product->category_id = $request->category_id;
        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->description = $request->description;

        $product->save();

        if ($product->save()){
            return $product;
        } else {
            return null;
        }
    }

    public function deleteProduct($productId)
    {
        $product = ProductModel::findOrFail($productId);
        if (!$product){
            return $this->error("No Product with ID $productId", 404);
        }

        $product->deleted = 1;
        $product->deleted_at = date('Y-m-d H:i:s');

        $product->save();

        if ($product->save()){
            return $product;
        } else {
            return null;
        }
    }

    public function getProductByCategory($categoryId)
    {
        return ProductModel::where('category_id', $categoryId)->where('deleted', 0)->get();
    }
}
