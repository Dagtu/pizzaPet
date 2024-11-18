<?php

namespace App\Modules\Order\Infrastructure\Http\Controllers;

use App\Modules\Order\Application\DataMappers\OrderMapper;
use App\Modules\Order\Application\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderAdminController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly OrderMapper $orderMapper
    ) {}

    public function completeOrder(Request $request) : JsonResponse
    {
        try {
            $request->validate(['id' => ['required', 'integer']]);
            $completeOrderDTO = $this->orderMapper->mapToCompleteOrderDTOFromRequest($request->integer('id'));
            $this->orderService->complete($completeOrderDTO);
            return response()->json('Order completed');
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
