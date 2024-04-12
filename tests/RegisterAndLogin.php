
<?php
// tests/UserAuthenticationTest.php
use PHPUnit\Framework\TestCase;

class UserAuthenticationTest extends TestCase
{
    private $pdo;

    public function setUp(): void {
        $this->pdo = new PDO('mysql:host=localhost;dbname=testdb', 'user', 'password');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function tearDown(): void {
        $this->pdo = null;
    }

    public function testUserRegistration() {
        $username = "testuser";
        $password = "testpass";
        $email = "test@example.com";

        // Simulate registering a user
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $email]);

        // Check that the user was inserted
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($result);
        $this->assertEquals($username, $result['username']);
    }

    public function testUserLogin() {
        $username = "testuser";
        $password = "testpass";

        // Simulate logging in a user
        $stmt = $this->pdo->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertTrue(password_verify($password, $result['password']));
    }
}
?>
