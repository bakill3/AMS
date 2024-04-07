<?php

namespace Deost\Ams\Controllers;

use Deost\Ams\Events\UserLoggedOutEvent;
use Predis\Client as Redis;

class LogoutController {
    private Redis $redis;

    public function __construct(Redis $redis) {
        $this->redis = $redis;
    }

    public function logout(): void {
        $userId = $_SESSION['user_id'] ?? null;
        if ($userId) {
            session_destroy();
            $event = new UserLoggedOutEvent($userId);
            $this->redis->publish('user.loggedout', serialize($event));
        }
        header("Location: /public/login.php");
        exit;
    }
}
