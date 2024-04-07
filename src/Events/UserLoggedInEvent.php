<?php

namespace Deost\Ams\Events;

class UserLoggedInEvent {
    public function __construct(public string $username) {}
}
