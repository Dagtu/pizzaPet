<?php

namespace App\Modules\User\Application\Input\RequestsDTO;

use App\Modules\Common\Domain\ValueObjects\IdValue;
use App\Modules\Common\Domain\ValueObjects\PhoneValue;

class PhoneDTO
{
    public function __construct(
        public PhoneValue $phone,
        public ?IdValue $id = null,
    ) {}

    public function setPhoneId($id): void
    {
        $this->id = new IdValue($id);
    }

    public function getPhoneId(): ?int
    {
        return $this->id?->getValue();
    }

    public function getPhone(): string
    {
        return $this->phone->getValue();
    }
}
