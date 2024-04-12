<?php

namespace Deost\Ams\Controllers;

use Deost\Ams\Events\UserLoggedInEvent;
use Deost\Ams\Model\UserModel;
use Predis\Client as Redis;

class LoginController {
    private UserModel $userModel;
    private Redis $redis;

    public function __construct(UserModel $userModel, Redis $redis) {
        ob_start();
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $this->userModel = $userModel;
        $this->redis = $redis;
    }

    public function login(string $username, string $password): void {
        error_log("Attempting login for user: $username");

        if ($this->userModel->validateUser($username, $password)) {
            $_SESSION['username'] = $username;
            $event = new UserLoggedInEvent($username);
            $this->redis->publish('user.loggedin', serialize($event));

            error_log("Login successful for user: $username");
            header("Location: /chat");
            exit;
        } else {
            $_SESSION['login_error'] = "Login failed. Please check your credentials.";
            error_log("Login failed for user: $username. Credentials check failed.");
            header("Location: /login?error=loginFailed");
            exit;
        }
    }
}
