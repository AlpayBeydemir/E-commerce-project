<?php

namespace App\Interfaces;

interface IOrderRepositoryInterface
{
    public function getAllOrders();

    public function getOrderById($orderId);

    public function createOrder(array $orderDetails);

    public function updateOrder($orderId, array $orderDetails);

    public function deleteOrder($orderId);
}
