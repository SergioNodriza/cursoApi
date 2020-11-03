<?php

declare(strict_types=1);

namespace App\Exceptions\Password;


use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PasswordException extends BadRequestException
{

    public static function invalidLenght(): self
    {
        throw new self('Password must be at least 6 characters');
    }
}