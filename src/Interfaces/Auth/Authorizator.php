<?php

namespace Lylink\Interfaces\Auth;

interface Authorizator
{
    public function isAuthorized(): bool;
    public function login(string $usernamemail, string $password): void;
    public function logout(): void;
}
