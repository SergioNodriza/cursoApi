<?php

declare(strict_types=1);

namespace App\Exceptions\Group;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class UserAlreadyMemberOfGroup extends ConflictHttpException
{
    public function __construct()
    {
        parent::__construct('This user is already member of the group');
    }
}