<?php

namespace App\Modules\Order\Infrastructure\Repositories;

use App\Modules\Order\Application\DataMappers\OrderMapper;
use App\Modules\Order\Application\Exceptions\OrderRepositoryException;
use App\Modules\Order\Application\Repositories\OrderRepositoryInterface;
use App\Modules\Order\Domain\Entities\OrderEntity;
use App\Modules\Order\Infrastructure\Models\Order;
use DB;
use Exception;
use Illuminate\Support\Carbon;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @throws OrderRepositoryException
     */
    public function create(
        int $clientId,
        int $clientAddressId,
        int $clientPhoneId,
        string $comment,
        float $totalPrice,
        array $products,
        string $status
    ) : OrderEntity
    {
        DB::beginTransaction();

        try {
            $order = Order::create([
                'time' => Carbon::now(),
                'status' => $status,
                'courier_id' => null,
                'client_id' => $clientId,
                'client_address_id' => $clientAddressId,
                'client_phone_id' => $clientPhoneId,
                'comment' => $comment,
                'total_price' => $totalPrice,
            ]);

            $order->items()->createMany($products);

            DB::commit();
        } catch (Exception) {
            DB::rollBack();
            throw new OrderRepositoryException(OrderRepositoryException::CODE_ERROR_CREATING_ORDER);
        }

        return OrderMapper::mapToEntityFromDB(
            $order->id,
            $order->client_id,
            $order->client_address_id,
            $order->client_phone_id,
            $order->comment,
            $order->total_price,
            $order->status
        );
    }

    public function updateStatus(int $id, string $status) : bool
    {
        return Order::query()->where('id', $id)->update(['status' => $status]) > 0;
    }

    /**
     * @throws OrderRepositoryException
     */
    public function complete(
        int $id,
        string $orderStatusComplete,
        string $paymentStatusComplete,
        string $courierStatusComplete
    ) : void
    {
        DB::beginTransaction();

        try {
            $order = Order::query()->where('id', $id)->first();
            if (is_null($order)) {
                throw new OrderRepositoryException(OrderRepositoryException::CODE_ERROR_ORDER_NOT_FOUND);
            }

            $order->update(['status' => $orderStatusComplete]);
            $order->payment()->update(['status' => $paymentStatusComplete]);
            $order->courier()->update(['status' => $courierStatusComplete]);

            DB::commit();
        } catch (Exception) {
            DB::rollBack();
            throw new OrderRepositoryException(OrderRepositoryException::CODE_ERROR_COMPLETING_ORDER);
        }
    }
}
