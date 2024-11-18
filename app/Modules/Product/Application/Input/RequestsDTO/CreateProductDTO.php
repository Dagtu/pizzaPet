<?php

namespace App\Modules\Product\Application\Input\RequestsDTO;

use App\Modules\Common\Domain\ValueObjects\IsActiveValue;
use App\Modules\Product\Domain\ValueObjects\DescriptionValue;
use App\Modules\Product\Domain\ValueObjects\ImageUrlValue;
use App\Modules\Product\Domain\ValueObjects\NameValue;
use App\Modules\Product\Domain\ValueObjects\PriceValue;
use App\Modules\Product\Domain\ValueObjects\TypeValue;

class CreateProductDTO
{
    public function __construct(
        public readonly NameValue $name,
        public readonly TypeValue $type,
        public readonly IsActiveValue $isActive,
        public readonly PriceValue $price,
        public readonly ImageUrlValue $imageUrl,
        public readonly DescriptionValue $description
    ) {}

    public function getName(): string
    {
        return $this->name->getValue();
    }

    public function getType(): string
    {
        return $this->type->getValue();
    }

    public function getIsActive(): bool
    {
        return $this->isActive->getValue();
    }

    public function getPrice(): float
    {
        return $this->price->getValue();
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl->getValue();
    }

    public function getDescription(): string
    {
        return $this->description->getValue();
    }


}
