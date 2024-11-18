<?php

namespace App\Modules\Order\Application\DataMappers;

use App\Modules\Common\Domain\ValueObjects\IdValue;
use App\Modules\Order\Application\Input\RequestsDTO\CompleteOrderDTO;
use App\Modules\Order\Application\Input\RequestsDTO\CreateOrderDTO;
use App\Modules\Order\Domain\Entities\OrderEntity;
use App\Modules\Order\Domain\ValueObjects\PaymentTypeValue;
use App\Modules\Payment\Domain\ValueObjects\CommentValue;
use App\Modules\Product\Application\DataMapper\ProductMapper;
use App\Modules\User\Application\DataMappers\ClientMapper;

class OrderMapper
{
    public static function mapToEntityFromDB(
        int $id,
        int $clientId,
        int $clientAddressId,
        int $clientPhoneId,
        string $comment,
        float $totalPrice,
        string $status
    ) : OrderEntity
    {
        return new OrderEntity($id, $clientId, $clientAddressId, $clientPhoneId, $comment, $totalPrice, $status);
    }

    public function mapToCreateOrderDTOFromRequest(
        int $clientId,
        array $products,
        array $address,
        array $phone,
        string $comment,
        string $paymentType
    ) : CreateOrderDTO
    {
        return new CreateOrderDTO(
            new IdValue($clientId),
            (new ProductMapper())->mapToProductsDTOFromRequest($products),
            (new ClientMapper())->mapToClientAddressDTOFromRequest(
                $address['region'],
                $address['city'],
                $address['street'],
                (int) $address['house'],
                (int) $address['apartment'],
                (int) $address['id']
            ),
            (new ClientMapper())->mapToClientPhoneDTOFromRequest($phone['number'], (int) $phone['id']),
            new CommentValue($comment),
            new PaymentTypeValue($paymentType),
        );
    }

    public function mapToCompleteOrderDTOFromRequest(int $id): CompleteOrderDTO
    {
        return new CompleteOrderDTO(new IdValue($id));
    }
}
