<?php

declare(strict_types=1);

namespace App\Api\Action\User;

use App\Service\User\ResendActivationEmailService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ResendActivationEmail
{

    private ResendActivationEmailService $activationEmail;

    public function __construct(ResendActivationEmailService $activationEmail)
    {

        $this->activationEmail = $activationEmail;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->activationEmail->resend($request);

        return new JsonResponse(['message' => 'Activation email sent']);
    }
}