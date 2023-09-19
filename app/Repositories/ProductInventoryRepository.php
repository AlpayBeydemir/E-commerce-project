<?php

namespace App\Repositories;

use App\Interfaces\IProductInventoryRepositoryInterface;
use App\Models\ProductInventoryModel;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class ProductInventoryRepository implements IProductInventoryRepositoryInterface
{

    use ResponseAPI;

    public function getProductInventory(int $productId, string $size = null, string $color = null)
    {
        if ($productId && intval($productId) > 0) {
            return ProductInventoryModel::with(['product'])->where('product_id', $productId)->where('size', $size)->where('color', $color)->get();
        } else {
            return null;
        }
    }

    public function createProductInventory($request)
    {
        $productInventory = new ProductInventoryModel();

        $productInventory->product_id = $request->product_id;
        $productInventory->quantity = $request->quantity;
        $productInventory->size = $request->size;
        $productInventory->color = $request->color;

        $productInventory->save();

        if ($productInventory->save()) {
            return $productInventory;
        } else {
            return null;
        }
    }

    public function updateProductInventory($request, int $inventoryId)
    {
        $productInventory = ProductInventoryModel::findOrFail($inventoryId);

        if (!$productInventory) {
            return $this->error("No Inventory of Product with ID $inventoryId", 404);
        }

        $productInventory->product_id = $request->product_id;
        $productInventory->quantity = $request->quantity;
        $productInventory->size = $request->size;
        $productInventory->color = $request->color;

        $productInventory->save();

        if ($productInventory->save()) {
            return $productInventory;
        } else {
            return null;
        }
    }

    public function deleteProductInventory(int $inventoryId)
    {
        $productInventory = ProductInventoryModel::findOrFail($inventoryId);

        if (!$productInventory){
            return $this->error("No Product with ID $inventoryId", 404);
        }

        $productInventory->delete();

        if ($productInventory->delete()){
            return $productInventory;
        } else {
            return null;
        }
    }
}
