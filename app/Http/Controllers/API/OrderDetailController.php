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
    public function index()
    {
        return response()->json([
            'data' => $this->orderRepository->getAllOrders()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json([
            'data' => $this->orderRepository->getOrderById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->orderRepository->deleteOrder($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
