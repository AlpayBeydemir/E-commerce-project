<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Interfaces\IProductRepositoryInterface;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    private IProductRepositoryInterface $productRepository;
    private $responseApi;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->responseApi = new ResponseApi();
    }

    public function index()
    {
        try {

            $products = $this->productRepository->getAllProducts();

            if (count($products) > 0) {
                return $this->responseApi->success('All Products', $products);
            } else {
                return [];
            }
        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function store(ProductRequest $request)
    {
        try {

            $store = $this->productRepository->createProduct($request);

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

            $product = $this->productRepository->getProductById($id);

            if ($product) {
                return $this->responseApi->success("$product->name", $product);
            } else {
                return $this->responseApi->error("No Product with Id $id", 404);
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function update(ProductRequest $request, string $id)
    {
        try {

            $update = $this->productRepository->updateProduct($request, $id);

            if ($update) {
                return $this->responseApi->success("Product Updated", $update);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function destroy(string $id)
    {
        try {

            $delete = $this->productRepository->deleteProduct($id);

            if ($delete) {
                return $this->responseApi->success("Product Deleted", $delete);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function categoryProduct($id)
    {
        try {

            $categoryProducts = $this->productRepository->getProductByCategory($id);

            if ($categoryProducts) {
                return $this->responseApi->success("Products", $categoryProducts);
            } else {
                return $this->responseApi->error("No Category Products wiht Id $id", 404);
            }

        } catch (\Exception $exception) {
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }
}
