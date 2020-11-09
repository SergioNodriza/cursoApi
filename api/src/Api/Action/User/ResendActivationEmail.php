<?php

declare(strict_types=1);

namespace App\Api\Action\User;

use App\Service\Request\RequestService;
use App\Service\User\ResendActivationEmailService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ResendActivationEmail
{
    private ResendActivationEmailService $activationEmail;

    public function __construct(ResendActivationEmailService $activationEmail)
    {
        $this->activationEmail = $activationEmail;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->activationEmail->resend(
            RequestService::getField($request, 'email')
        );

        return new JsonResponse(['message' => 'Activation email sent']);
    }
}
