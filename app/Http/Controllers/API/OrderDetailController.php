<?php

namespace App\Http\Controllers\API;

use App\Interfaces\IOrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderDetailController extends Controller
{
    private IOrderRepositoryInterface $orderRepository;

    public function __construct(IOrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->orderRepository->getAllOrders()
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $orderDetails = $request->only([
            'user_id',
            'total'
        ]);

        return response()->json([
            'data' => $this->orderRepository->createOrder($orderDetails)
        ],
        Response::HTTP_CREATED
        );
    }

    public function show(string $id): JsonResponse
    {
        return response()->json([
            'data' => $this->orderRepository->getOrderById($id)
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $orderDetails = $request->only([
            'user_id',
            'total'
        ]);

        return response()->json([
            'data' => $this->orderRepository->updateOrder($id, $orderDetails)
        ]);
    }

    public function destroy(string $id)
    {
        $this->orderRepository->deleteOrder($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
