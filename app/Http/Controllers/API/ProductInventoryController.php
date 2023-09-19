<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductInventoryRequest;
use App\Interfaces\IProductInventoryRepositoryInterface;
use Illuminate\Http\Request;

class ProductInventoryController extends Controller
{
    private IProductInventoryRepositoryInterface $productInventoryRepository;
    private $responseApi;

    public function __construct(IProductInventoryRepositoryInterface $productInventoryRepository)
    {
        $this->productInventoryRepository = $productInventoryRepository;
        $this->responseApi = new ResponseApi();
    }

    public function index($id)
    {
        try {

            $productInventory = $this->productInventoryRepository->getProductInventory($id);

            if ($productInventory){
                $this->responseApi->success("Inventory of Product", $productInventory);
            } else {
                $this->responseApi->error("Error");
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function store(ProductInventoryRequest $request)
    {
        try {

            $store = $this->productInventoryRepository->createProductInventory($request);

            if ($store){
                $this->responseApi->success("Inventory of Product Created", $store);
            } else {
                return $this->responseApi->error("Error");
            }
        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function update(ProductInventoryRequest $request, int $id)
    {
        try {

            $update = $this->productInventoryRepository->updateProductInventory($request, $id);

            if ($update){
                $this->responseApi->success("Inventory of Product Created", $update);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function destroy(int $id)
    {
        try {

            $delete = $this->productInventoryRepository->deleteProductInventory($id);

            if ($delete){
                return $this->responseApi->success("Inventory of Product Deleted", $delete);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }
}
