<?php

namespace Deost\Ams\Controllers;

use Deost\Ams\Events\UserLoggedInEvent;
use Deost\Ams\Model\UserModel;
use Predis\Client as Redis;

class LoginController {
    private UserModel $userModel;
    private Redis $redis;

    public function __construct(UserModel $userModel, Redis $redis) {
        $this->userModel = $userModel;
        $this->redis = $redis;
    }

    public function login(string $username, string $password): void {
        if ($this->userModel->validateUser($username, $password)) {
            $_SESSION['username'] = $username; // Store username in session to indicate successful login
            $event = new UserLoggedInEvent($username);
            $this->redis->publish('user.loggedin', serialize($event));
            header("Location: /chat"); // Adjusted to match the routing setup
            exit;
        } else {
            $_SESSION['login_error'] = "Login failed. Please check your credentials.";
            header("Location: /login"); // Redirect back to the login page to display the error
            exit;
        }
    }
}
