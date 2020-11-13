<?php

declare(strict_types=1);

namespace App\Exceptions\Group;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class OwnerCannotBeDeletedException extends ConflictHttpException
{
    public function __construct()
    {
        parent::__construct('Owner can not be deleted from a group. Try deleting the group instead');
    }
}