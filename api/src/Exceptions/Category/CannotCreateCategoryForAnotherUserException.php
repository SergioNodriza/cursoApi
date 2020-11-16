<?php

declare(strict_types=1);

namespace App\Exceptions\Category;


use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CannotCreateCategoryForAnotherUserException extends AccessDeniedHttpException
{
    public function __construct(string $message = null, \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct('You can not create categories for another group');
    }
}