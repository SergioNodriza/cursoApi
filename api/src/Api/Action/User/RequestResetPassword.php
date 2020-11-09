<?php

declare(strict_types=1);

namespace App\Api\Action\User;

use App\Service\Request\RequestService;
use App\Service\User\RequestResetPasswordService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RequestResetPassword
{
    private RequestResetPasswordService $requestResetPassword;

    public function __construct(RequestResetPasswordService $requestResetPassword)
    {

        $this->requestResetPassword = $requestResetPassword;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->requestResetPassword->send(
            RequestService::getField($request, 'email')
        );

        return new JsonResponse(['message' => 'Request reset password email sent']);
    }
}