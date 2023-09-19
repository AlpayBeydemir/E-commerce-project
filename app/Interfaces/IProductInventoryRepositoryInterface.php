<?php

namespace App\Interfaces;

use App\Models\ProductInventoryModel;

interface IProductInventoryRepositoryInterface
{
    public function getProductInventory(int $productId, string $size = null, string $color = null);

    public function createProductInventory(ProductInventoryModel $inventory);

    public function updateProductInventory(ProductInventoryModel $inventory, int $inventoryId);

    public function deleteProductInventory(int $inventoryId);
}
