<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\IProductInventoryRepositoryInterface;

class ProductInventoryController extends Controller
{
    private IProductInventoryRepositoryInterface $productInventoryRepository;

    public function __construct(IProductInventoryRepositoryInterface $productInventoryRepository)
    {
        $this->productInventoryRepository = $productInventoryRepository;
    }

    public function index($id)
    {
        return $this->productInventoryRepository->getProductInventory($id);
    }
}
