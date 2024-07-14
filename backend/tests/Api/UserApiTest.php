<?php
namespace App\Tests\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserApiTest extends WebTestCase
{
    public function testGetUserByIdJohnDoe(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/users/1');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        // Assert that the response is the expected JSON
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(1, $response['id']);
        $this->assertEquals('JohnDoe', $response['displayName']);
        $this->assertEquals('Software developer with a passion for coding and learning new technologies.', $response['aboutMe']);
        $this->assertEquals('2023-01-01T10:00:00+00:00', $response['creationDate']);
        $this->assertEquals(5, $response['downVotes']);
        $this->assertEquals('2023-06-01T14:00:00+00:00', $response['lastAccessDate']);
        $this->assertEquals('New York, NY', $response['location']);
        $this->assertEquals(1500, $response['reputation']);
        $this->assertEquals(300, $response['upVotes']);
        $this->assertEquals(100, $response['views']);
        $this->assertEquals('https://johndoe.dev', $response['websiteUrl']);
    }

    public function testGetUserByIdJaneDoe(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/users/2');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        // Assert that the response is the expected JSON
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(2, $response['id']);
        $this->assertEquals('JaneSmith', $response['displayName']);
        $this->assertEquals('Enthusiastic data scientist and machine learning expert.', $response['aboutMe']);
        $this->assertEquals('2022-05-15T08:30:00+00:00', $response['creationDate']);
        $this->assertEquals(3, $response['downVotes']);
        $this->assertEquals('2023-07-01T09:45:00+00:00', $response['lastAccessDate']);
        $this->assertEquals('San Francisco, CA', $response['location']);
        $this->assertEquals(2000, $response['reputation']);
        $this->assertEquals(500, $response['upVotes']);
        $this->assertEquals(200, $response['views']);
        $this->assertEquals('https://janesmith.ai', $response['websiteUrl']);
    }
}
