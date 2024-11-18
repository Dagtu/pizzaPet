<?php

namespace App\Modules\Product\Domain\Enums;

enum ProductTypes : string
{
    case Pizza = 'pizza';
    case Drink = 'drink';
    case Snack = 'snack';
    case Sauce = 'sauce';
    case Dessert = 'dessert';
}
