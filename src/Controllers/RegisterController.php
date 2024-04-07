<?php

namespace Deost\Ams\Controllers;

use Deost\Ams\Events\UserRegisteredEvent;
use Deost\Ams\Model\UserModel;
use Predis\Client as Redis;

class RegisterController {
    private UserModel $userModel;
    private Redis $redis;

    public function __construct(UserModel $userModel, Redis $redis) {
        $this->userModel = $userModel;
        $this->redis = $redis;
    }

    public function register(string $username, string $password): void {
        if ($this->userModel->createUser($username, $password)) {
            $event = new UserRegisteredEvent($username);
            $this->redis->publish('user.registered', serialize($event));
            header("Location: /public/login.php");
            exit;
        } else {
            echo "Registration failed. The username might already exist.";
            exit;
        }
    }
}
