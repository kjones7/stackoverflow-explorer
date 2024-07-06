<?php
namespace App\Tests\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserApiTest extends WebTestCase
{
    public function testGetUserById(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/users/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        // Assert that the response is the expected JSON
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(1, $response['id']);
        $this->assertEquals('Jeff Atwood', $response['displayName']);
    }
}
