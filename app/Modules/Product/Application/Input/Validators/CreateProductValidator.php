<?php

namespace App\Modules\Product\Application\Input\Validators;

use App\Modules\Product\Application\Exceptions\CreateProductInputException;
use App\Modules\Product\Application\Input\RequestsDTO\CreateProductDTO;

class CreateProductValidator
{
    /**
     * @param CreateProductDTO $requestDTO
     * @return void
     * @throws CreateProductInputException
     */
    public function validate(CreateProductDTO $requestDTO): void
    {
        if (empty($requestDTO->name)) {
            throw new CreateProductInputException('Name is required');
        }

        if (empty($requestDTO->type)) {
            throw new CreateProductInputException('Type is required');
        }

        if (empty($requestDTO->price)) {
            throw new CreateProductInputException('Price is required');
        }

        if (empty($requestDTO->imageUrl)) {
            throw new CreateProductInputException('Image url is required');
        }

        if (empty($requestDTO->description)) {
            throw new CreateProductInputException('Description is required');
        }
    }
}
