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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
