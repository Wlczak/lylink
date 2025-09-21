<?php

namespace Lylink\Interfaces\Auth;

interface Authorizator
{
    /**
     * @return array{errors: list<string>, success: bool, usermail: string}
     */
    public function login(string $usernamemail, string $password): array;
    public function logout(): void;
}
