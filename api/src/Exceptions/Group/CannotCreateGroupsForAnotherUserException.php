<?php


namespace App\Exceptions\Group;


use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CannotCreateGroupsForAnotherUserException extends AccessDeniedHttpException
{
    public function __construct()
    {
        parent::__construct('You can not create groups for another user');
    }
}