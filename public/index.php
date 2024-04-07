<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Deost\Ams\Controllers\LoginController;
use Deost\Ams\Controllers\LogoutController;
use Deost\Ams\Controllers\RegisterController;
use Deost\Ams\Model\UserModel;
use Predis\Client as Redis;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$redisHost = $_ENV['REDIS_HOST'] ?? 'redis';

// Create a Logger instance
$log = new Logger('ams');
$log->pushHandler(new StreamHandler(__DIR__.'/../logs/app.log', Logger::WARNING));

// Database connection
try {
    $pdo = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $log->error("Database connection failed: " . $e->getMessage());
    die("Database connection failed: " . $e->getMessage());
}

// Redis client for event publishing
$redis = new Redis(['scheme' => 'tcp', 'host' => $redisHost, 'port' => 6379]);

// Initialize UserModel with PDO
$userModel = new UserModel($pdo);

// Instantiate controllers with corrected order
$loginController = new LoginController($userModel, $redis);
$logoutController = new LogoutController($redis);
$registerController = new RegisterController($userModel, $redis);

// Routing (basic example)
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestPath) {
    case '/':
        echo "Welcome to AMS!";
        break;
    case '/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $loginController->login($username, $password);
        } else {
            require __DIR__ . '/login.php';
        }
        break;
    case '/logout':
        $logoutController->logout();
        break;
    case '/register':
        // Placeholder for registration page
        echo "Register Page";
        break;
    default:
        http_response_code(404);
        echo "Page not found";
}
