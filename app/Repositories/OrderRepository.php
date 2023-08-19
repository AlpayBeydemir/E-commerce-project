<?php

namespace App\Repositories;

use App\Interfaces\IOrderRepositoryInterface;
use App\Models\OrderDetailsModel;

class OrderRepository implements IOrderRepositoryInterface
{

    public function getAllOrders()
    {
        return OrderDetailsModel::all();
    }

    public function getOrderById($orderId)
    {
        return OrderDetailsModel::findOrFail($orderId);
    }

    public function createOrder(array $orderDetails)
    {
        return OrderDetailsModel::create($orderDetails);
    }

    public function updateOrder($orderId, array $orderDetails)
    {
        return OrderDetailsModel::whereId($orderId)->update($orderDetails);
    }

    public function deleteOrder($orderId)
    {
        return OrderDetailsModel::destroy($orderId);
    }
}
