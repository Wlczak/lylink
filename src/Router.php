<?php
declare (strict_types = 1);

namespace Lylink;

use Pecee\SimpleRouter\SimpleRouter;

class Router
{
    public static function handle(): void
    {
        SimpleRouter::get('/', [self::class, 'home']);

        SimpleRouter::start();
    }

    public static function home(): string
    {
        return "Hello";
    }
}
