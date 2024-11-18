<?php

namespace App\Modules\Order\Infrastructure\Http\Controllers;

use App\Modules\Order\Application\DataMappers\OrderMapper;
use App\Modules\Order\Application\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderClientController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly OrderMapper $orderMapper
    ) {}

    public function create(Request $request) : JsonResponse
    {
//        try {
           $request->validate([
                'clientId' => 'required|integer',
                'products' => 'required|array',
                'products.*.id' => 'required|integer',
                'products.*.quantity' => 'required|integer',
                'products.*.price' => 'required|numeric',
                'address' => 'required|array',
                'address.id' => 'required|integer',
                'address.city' => 'required|string',
                'address.region' => 'required|string',
                'address.street' => 'required|string',
                'address.house' => 'required|int',
                'address.apartment' => 'required|int',
                'phone' => 'required|array',
                'phone.id' => 'required|integer',
                'phone.number' => 'required|string',
                'comment' => 'nullable|string',
                'paymentType' => 'required|string',
            ]);

            $orderDTO = $this->orderMapper->mapToCreateOrderDTOFromRequest(
                $request->integer('clientId'),
                $request->input('products'),
                $request->input('address'),
                $request->input('phone'),
                $request->string('comment'),
                $request->string('paymentType')
            );

            $this->orderService->create($orderDTO);

            return response()->json('Order created');
//        } catch (Exception $e) {
//            return response()->json(
//                ['message' => $e->getMessage()],
//                $e->getCode() ?: 500
//            );
//        }
    }
}
