<?php

declare(strict_types=1);

namespace App\Tests\Functional\User;

use Symfony\Component\HttpFoundation\JsonResponse;

class ResetPasswordActionTest extends UserTestBase
{

    public function testResetPassword(): void
    {
        $peterID = $this->getPeterId();

        $payload = [
            'resetPasswordToken' => '123456',
            'password' => 'new-password'
        ];

        self::$peter->request('PUT', \sprintf('%s/%s/reset_password', $this->endpoint, $peterID), [], [], [], \json_encode($payload));

        $response = self::$peter->getResponse();
        $responseData = $this->getResponseData($response);

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertEquals($peterID, $responseData['id']);
    }
}