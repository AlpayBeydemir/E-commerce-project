<?php

namespace App\Interfaces;

interface IProductInventoryRepositoryInterface
{
    public function getProductInventory($productId);
}
