<?php

namespace App\Interfaces;

use App\Models\ShoppingCartModel;

interface IShoppingChartRepositoryInterface
{
    public function getAllShopCart();
    public function getShopCartByUserId($productId);
    public function createShopCart(ShoppingCartModel $shoppingCart);
    public function updateShopCart(ShoppingCartModel $shoppingCart, int $cartId);
    public function deleteAllProductsInShopCart(int $userId);
}
