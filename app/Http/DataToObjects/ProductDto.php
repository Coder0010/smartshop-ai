<?php

namespace App\Http\DataToObjects;

use Illuminate\Http\UploadedFile;
use MkamelMasoud\StarterCoreKit\Core\BaseDto;

class ProductDto extends BaseDto
{
    public string $name = '';

    public ?string $description = null;

    public float $price = 0;

    public UploadedFile|string|null $image = null;
}
