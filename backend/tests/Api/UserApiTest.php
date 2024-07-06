<?php
namespace App\Tests\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserApiTest extends WebTestCase
{
    protected static $pdo;

    // Before all tests, set up the database
    public static function setUpBeforeClass(): void
    {
        // Get the DATABASE_URL environment variable
        $databaseUrl = $_ENV['MASTER_DATABASE_URL'] ?? $_SERVER['MASTER_DATABASE_URL'] ?? false;

        if ($databaseUrl === false) {
            throw new \RuntimeException('DATABASE_URL environment variable is not set.');
        }

        // Parse the DATABASE_URL
        $urlParts = parse_url($databaseUrl);
        $dsn = sprintf(
            'sqlsrv:server=%s;Database=%s',
            $urlParts['host'],
            ltrim($urlParts['path'], '/')
        );
        $username = $urlParts['user'];
        $password = $urlParts['pass'];

        try {
            self::$pdo = new \PDO($dsn, $username, $password);
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    // Tear down the database after each test
    protected function tearDown(): void
    {
        // SQL commands to set single-user mode, restore database, and set multi-user mode
        $sqls = [
            "ALTER DATABASE [StackOverflow2013] SET SINGLE_USER WITH ROLLBACK IMMEDIATE;",
            "RESTORE DATABASE [StackOverflow2013] FROM DATABASE_SNAPSHOT = 'StackOverflow2013_Snapshot';",
            "ALTER DATABASE [StackOverflow2013] SET MULTI_USER;"
        ];

        // Execute the SQL commands
        if (self::$pdo) {
            try {
                foreach ($sqls as $sql) {
                    self::$pdo->exec($sql);
                }
                echo "Database restored successfully.\n";
            } catch (\PDOException $e) {
                echo 'Failed to restore database: ' . $e->getMessage();
            }
        }

        // Ensure the kernel is shut down between tests
        static::ensureKernelShutdown();
    }

    public function testGetUserById(): void
    {
        // Create a new client to send HTTP requests
        $client = static::createClient();
        $client->request('GET', '/api/users/1');

        // Assert that the response status code is 200 (OK)
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

        // Assert that the response contains the expected data
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(1, $response['id']);
        $this->assertEquals('Jeff Atwood', $response['displayName']);
    }
}
