<?php

declare(strict_types=1);

namespace App\Exceptions\Password;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PasswordException extends BadRequestException
{
    public static function invalidLength(): self
    {
        throw new self('Password must be at least 6 characters');
    }

    public static function oldPAsswordDoesNotMatch(): self
    {
        throw new self('Old password does not match');
    }
}
