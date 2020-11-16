<?php


namespace App\Exceptions\Category;


use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CannotCreateCategoryForAnotherGroupException extends AccessDeniedHttpException
{
    public function __construct()
    {
        parent::__construct('You can not create categories for another group');
    }
}