<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppingCartRequest;
use App\Interfaces\IShoppingChartRepositoryInterface;
use App\Repositories\ShopppingCartRepository;
use Illuminate\Http\Request;
use function Symfony\Component\String\s;

class ShoppingCartController extends Controller
{
    private IShoppingChartRepositoryInterface $shoppingChartRepository;
    private $responseApi;

    public function __construct()
    {
        $this->shoppingChartRepository = new ShopppingCartRepository();
        $this->responseApi = new ResponseApi();
    }

    public function index()
    {
        try {

            $shoppingCarts = $this->shoppingChartRepository->getAllShopCart();

            if (count($shoppingCarts) > 0){
                return $this->responseApi->success("All Shopping Cart", $shoppingCarts);
            } else {
                return [];
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function store(ShoppingCartRequest $request)
    {
        try {

            $store = $this->shoppingChartRepository->createShopCart($request);

            if ($store){
                return $this->responseApi->success("Shopping Cart Created", $store);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function show(string $id)
    {
        try {

            $shoppingCart = $this->shoppingChartRepository->getShopCartByUserId($id);

            if ($shoppingCart){
                return $this->responseApi->success("User Shopping Cart", $shoppingCart);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function update(ShoppingCartRequest $request, string $id)
    {
        try {

            $update = $this->shoppingChartRepository->updateShopCart($request, $id);

            if ($update){
                return $this->responseApi->success("Shopping Cart Updated", $update);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function destroy(string $id)
    {
        try {

            $delete = $this->shoppingChartRepository->deleteUserAllProductsInShopCart($id);

            if ($delete){
                return $this->responseApi->success("Shopping Cart Deleted", $delete);
            } else {
                return $this->responseApi->error("Error");
            }

        } catch (\Exception $exception){
            return $this->responseApi->error($exception->getMessage(), $exception->getCode());
        }
    }
}
