<?php

require_once __DIR__ . '/../bootstrap.php';

use Dotenv\Dotenv;
use Lylink\Router;

session_start();
session_regenerate_id();

if (isset($_SESSION['email_verify'])) {
    if (time() > $_SESSION['email_verify']['exp']) {
        unset($_SESSION['email_verify']);
    }
}

$dotenv = Dotenv::createImmutable(__DIR__ . '/../config');
$dotenv->safeLoad();

$devMode = $_ENV['DEV_MODE'] === "true" ? true : false;
try {
    Router::handle();
    Router::handle($devMode);
} catch (Exception $e) {
    echo $e;
}
