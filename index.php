<?php

require_once __DIR__ . '/vendor/autoload.php';
session_start();


use Lylink\Router;

Router::handle();
