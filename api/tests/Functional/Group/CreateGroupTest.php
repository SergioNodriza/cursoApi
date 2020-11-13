<?php

declare(strict_types=1);

namespace App\Tests\Functional\Group;

class CreateGroupTest extends GroupTestBase
{
    public function testCreateGroup(): void
    {
        $payload = [
            'name' => 'My new group',
            'owner' => \sprintf('/api/v1/users/%s', $this->getPeterId()),
        ];

        self::$peter->request('POST', $this->endpoint, [], [], [], \json_encode($payload));

        $response = self::$peter->getResponse();
        $responseData = $this->getResponseData($response);

        $this->assertEquals($payload['name'], $responseData['name']);
    }
}