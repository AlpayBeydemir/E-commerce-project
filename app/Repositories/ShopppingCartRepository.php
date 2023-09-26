<?php

namespace App\Repositories;

use App\Interfaces\IShoppingChartRepositoryInterface;
use App\Models\ShoppingCartModel;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Auth;

class ShopppingCartRepository implements IShoppingChartRepositoryInterface
{
    use ResponseAPI;

    public function getAllShopCart()
    {
        return ShoppingCartModel::all();
    }

    public function getShopCartByUserId($productId)
    {
        return ShoppingCartModel::where('user_id', Auth::user()->id)->where('deleted', 0)->orderBy('id', 'DESC')->first();
    }

    public function createShopCart($shoppingCart)
    {

        $shopping_cart = new ShoppingCartModel();

        $shopping_cart->user_id = $shoppingCart->user_id;
        $shopping_cart->product_id = $shoppingCart->product_id;
        $shopping_cart->quantity = $shoppingCart->quantity;
        $shopping_cart->save();

        if ($shopping_cart->save()) {
            return $shopping_cart;
        } else {
            return null;
        }
    }

    public function updateShopCart($shoppingCart, $cartId)
    {
        $shopping_cart = ShoppingCartModel::findOrFail($cartId);

        if (!$shopping_cart) {
            return $this->error("No Shopping Cart with ID $cartId", 404);
        }

        $shopping_cart->product_id = $shoppingCart->product_id;
        $shopping_cart->quantity = $shoppingCart->quantity;

        $shopping_cart->save();

        if ($shopping_cart->save()) {
            return $shopping_cart;
        } else {
            return null;
        }
    }

    public function deleteAllProductsInShopCart($userId)
    {
        $shopping_cart = ShoppingCartModel::findOrFail($userId);

        if (!$shopping_cart) {
            return $this->error("No Shopping Cart with User ID $userId", 404);
        }

        $shopping_cart->deleted = 1;
        $shopping_cart->deleted_at = date('Y-m-d H:i:s');

        $shopping_cart->save();

        if ($shopping_cart->save()) {
            return $shopping_cart;
        } else {
            return null;
        }
    }
}
