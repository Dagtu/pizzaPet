<?php

namespace App\Modules\Order\Application\Input\RequestsDTO;

use App\Modules\Common\Domain\ValueObjects\IdValue;
use App\Modules\Order\Domain\ValueObjects\PaymentTypeValue;
use App\Modules\Payment\Domain\ValueObjects\CommentValue;
use App\Modules\Product\Application\Input\RequestsDTO\ProductsDTO;
use App\Modules\User\Application\Input\RequestsDTO\AddressDTO;
use App\Modules\User\Application\Input\RequestsDTO\PhoneDTO;

class CreateOrderDTO
{
    public function __construct(
        public readonly IdValue $clientId,
        public readonly ProductsDTO $products,
        public readonly AddressDTO $address,
        public readonly PhoneDTO $phone,
        public readonly CommentValue $comment,
        public readonly PaymentTypeValue $paymentType,
    ) {}

    public function getTotalPrice() : float
    {
        $totalPrice = 0;
        foreach ($this->products->products as $product) {
            $totalPrice += $product->getPrice() * $product->getQuantity();
        }

        return $totalPrice;
    }

    public function getClientId() : int
    {
        return $this->clientId->getValue();
    }
}
