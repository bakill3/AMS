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
            $event = new UserLoggedInEvent($username);
            $this->redis->publish('user.loggedin', serialize($event));
            header("Location: /public/chat.php");
            exit;
        } else {
            echo "Login failed. Please check your credentials.";
            exit;
        }
    }
}
