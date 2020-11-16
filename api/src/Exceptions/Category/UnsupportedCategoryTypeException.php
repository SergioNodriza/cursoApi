<?php

declare(strict_types=1);

namespace App\Exceptions\Category;


use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UnsupportedCategoryTypeException extends BadRequestHttpException
{
    private const MESSAGE = 'Unsupported category %s';

    public static function fromType(string $type): self
    {
        throw new self(\sprintf(self::MESSAGE, $type));
    }
}