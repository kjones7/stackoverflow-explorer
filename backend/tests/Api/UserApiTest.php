<?php
namespace App\Tests\Api;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class UserApiTest extends WebTestCase
{
    private KernelBrowser $client;
    private SerializerInterface $serializer;
    private ?EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->entityManager = $this->client->getContainer()->get('doctrine')->getManager();
        $this->entityManager->beginTransaction();
        $this->entityManager->getConnection()->setAutoCommit(false);
        $this->serializer = $this->client->getContainer()->get(SerializerInterface::class);
    }

    protected function tearDown(): void
    {
        $this->entityManager->rollback();
        $this->entityManager->close();
        $this->entityManager = null;

        parent::tearDown();
    }

    public function testGetUsers(): void
    {
        $this->client->request('GET', '/api/users');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());

        // Assert that the response is the expected JSON
        $response = json_decode($this->client->getResponse()->getContent(), true);
        $user1 = $response[0];
        $user2 = $response[1];

        // Assert user 1 contains correct data from 'JohnDoe'
        $this->assertEquals(1, $user1['id']);
        $this->assertEquals('JohnDoe', $user1['displayName']);
        $this->assertEquals('Software developer with a passion for coding and learning new technologies.', $user1['aboutMe']);
        $this->assertEquals('2023-01-01T10:00:00+00:00', $user1['creationDate']);
        $this->assertEquals(5, $user1['downVotes']);
        $this->assertEquals('2023-06-01T14:00:00+00:00', $user1['lastAccessDate']);
        $this->assertEquals('New York, NY', $user1['location']);
        $this->assertEquals(1500, $user1['reputation']);
        $this->assertEquals(300, $user1['upVotes']);
        $this->assertEquals(100, $user1['views']);
        $this->assertEquals('https://johndoe.dev', $user1['websiteUrl']);

        // Assert user 2 contains correct data from 'JaneSmith'
        $this->assertEquals(2, $user2['id']);
        $this->assertEquals('JaneSmith', $user2['displayName']);
        $this->assertEquals('Enthusiastic data scientist and machine learning expert.', $user2['aboutMe']);
        $this->assertEquals('2022-05-15T08:30:00+00:00', $user2['creationDate']);
        $this->assertEquals(3, $user2['downVotes']);
        $this->assertEquals('2023-07-01T09:45:00+00:00', $user2['lastAccessDate']);
        $this->assertEquals('San Francisco, CA', $user2['location']);
        $this->assertEquals(2000, $user2['reputation']);
        $this->assertEquals(500, $user2['upVotes']);
        $this->assertEquals(200, $user2['views']);
        $this->assertEquals('https://janesmith.ai', $user2['websiteUrl']);
    }

    public function testGetUserByIdJohnDoe(): void
    {
        $this->client->request('GET', '/api/users/1');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());

        // Assert that the response is the expected JSON
        $response = json_decode($this->client->getResponse()->getContent(), true);
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
        $this->client->request('GET', '/api/users/2');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());

        // Assert that the response is the expected JSON
        $response = json_decode($this->client->getResponse()->getContent(), true);
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

    public function testCreateUser(): void
    {
        // Create User object
        $user = new User();
        $user->setReputation(0);
        $user->setCreationDate(new \DateTime('2024-07-19 10:00:00'));
        $user->setDisplayName('TheDude');
        $user->setLastAccessDate(new \DateTime('2024-07-19 14:00:00'));
        $user->setWebsiteUrl('https://example.dev');
        $user->setLocation('New York, NY');
        $user->setAboutMe('About me? I am the dude.');
        $user->setViews(0);
        $user->setUpVotes(0);
        $user->setDownVotes(0);
        $user->setAccountId(1337);

        // Serialize the User object to JSON
        $userJson = $this->serializer->serialize($user, 'json');

        // Send the request with JSON data
        $this->client->request(
            'POST',
            '/api/users',
            [],
            [],
            ['HTTP_CONTENT_TYPE' => 'application/json'],
            $userJson
        );

        $this->assertEquals(Response::HTTP_CREATED, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());

        // Assert that the response is the expected JSON
        $response = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(1337, $response['accountId']);
        $this->assertEquals('TheDude', $response['displayName']);
        $this->assertEquals('About me? I am the dude.', $response['aboutMe']);
        $this->assertEquals('2024-07-19T10:00:00+00:00', $response['creationDate']);
        $this->assertEquals(0, $response['downVotes']);
        $this->assertEquals('2024-07-19T14:00:00+00:00', $response['lastAccessDate']);
        $this->assertEquals('New York, NY', $response['location']);
        $this->assertEquals(0, $response['reputation']);
        $this->assertEquals(0, $response['upVotes']);
        $this->assertEquals(0, $response['views']);
        $this->assertEquals('https://example.dev', $response['websiteUrl']);
    }
}
