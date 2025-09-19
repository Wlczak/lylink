<?php
interface Authorizator
{
    public function isAuthorized(): bool;
    public function login(): void;
    public function logout(): void;
}