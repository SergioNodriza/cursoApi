<?php

declare(strict_types=1);

namespace App\Exceptions\Movement;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CannotCreateMovementToAnotherUserException extends AccessDeniedHttpException
{
    public function __construct()
    {
        parent::__construct('You can not create movements for another user');
    }
}