<?php

namespace App\Modules\Product\Application\Input\RequestsDTO;

use App\Modules\Product\Domain\ValueObjects\DescriptionValue;
use App\Modules\Product\Domain\ValueObjects\IdValue;
use App\Modules\Product\Domain\ValueObjects\ImageUrlValue;
use App\Modules\Product\Domain\ValueObjects\IsActiveValue;
use App\Modules\Product\Domain\ValueObjects\NameValue;
use App\Modules\Product\Domain\ValueObjects\PriceValue;
use App\Modules\Product\Domain\ValueObjects\TypeValue;

class UpdateProductDTO
{
    public function __construct(
        public IdValue $id,
        public NameValue $name,
        public TypeValue $type,
        public IsActiveValue $isActive,
        public PriceValue $price,
        public ImageUrlValue $imageUrl,
        public DescriptionValue $description
    ) {}

    public function getId(): int
    {
        return $this->id->getValue();
    }

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
