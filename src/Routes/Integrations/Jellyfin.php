<?php

namespace Lylink\Routes\Integrations;

use Lylink\Interfaces\Integration\IntegrationRoute;
use Lylink\Traits\IntegrationSetup;

class Jellyfin extends \Lylink\Router implements IntegrationRoute
{
    use IntegrationSetup;

    public static function connect(): string
    {
        return self::$twig->load('integrations/jellyfin/connect.twig')->render(['test' => 'test']);
    }

    public static function connectPost(): string
    {
        return "hello world";
    }

    public static function disconnect(): string
    {
        return self::$twig->load('integrations/jellyfin/disconnect.twig')->render(['test' => 'test']);
    }
}
