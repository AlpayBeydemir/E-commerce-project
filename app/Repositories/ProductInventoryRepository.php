<?php

namespace App\Repositories;

use App\Interfaces\IProductInventoryRepositoryInterface;
use App\Models\ProductInventoryModel;
use App\Traits\ResponseAPI;

class ProductInventoryRepository implements IProductInventoryRepositoryInterface
{

    use ResponseAPI;
    public function getProductInventory($productId)
    {
        try {

            if (is_numeric($productId) && intval($productId) > 0){
                $productInventory = ProductInventoryModel::with(['product'])->where('product_id', $productId)->get();
                return $this->success("Product Inventory", $productInventory);
            } else {
                return $this->error("No Product Inventory with $productId", 404);
            }

        } catch (\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
