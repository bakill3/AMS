<?php

namespace Deost\Ams\Events;

class UserRegisteredEvent {
    public function __construct(public string $username) {}
}
