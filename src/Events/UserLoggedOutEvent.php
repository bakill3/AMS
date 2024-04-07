<?php

namespace Deost\Ams\Events;

class UserLoggedOutEvent {
    public function __construct(public string $userId) {}
}
