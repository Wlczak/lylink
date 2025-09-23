<?php

namespace Lylink\Routes;

use Closure;
use Lylink\Auth\AuthSession;
use Lylink\Data\CurrentSong;
use Lylink\Data\Source;
use Lylink\Interfaces\Routing\Route;
use Lylink\Models\Settings;
use Lylink\Router;
use Pecee\SimpleRouter\SimpleRouter;

class LyricsRoute extends Router implements Route
{
    public static function setup(): Closure
    {
        return function () {
            SimpleRouter::get('/', [self::class, 'lyricsHome']);
            SimpleRouter::get('/spotify', [self::class, 'lyrics']);
            SimpleRouter::post('/spotify', [self::class, 'update']);
        };
    }

    public static function lyricsHome(): string
    {
        $auth = AuthSession::get();
        $sources = [];
        if ($auth == null) {
            header('Location: ' . $_ENV['BASE_DOMAIN'] . '/login');
            die();
        }
        $user = $auth->getUser();
        if ($user == null) {
            header('Location: ' . $_ENV['BASE_DOMAIN'] . '/login');
            die();
        }
        $id = $user->getId();
        if ($id === null) {
            header('Location: ' . $_ENV['BASE_DOMAIN'] . '/login');
            die();
        }
        $settings = Settings::getSettings($id);

        if ($settings->spotify_connected) {
            $sources[] = new Source(id: 1, name: "Spotify", route: "/lyrics/spotify", current_song: new CurrentSong(id: "1", title: "Test song", artist: "Test artist", progress_ms: 5000, duration_ms: 100000));
        }

        if ($settings->jellyfin_connected) {
            $sources[] = new Source(id: 2, name: "Jellyfin", route: "/lyrics/jellyfin", current_song: new CurrentSong(id: "2", title: "Episode X", progress_ms: 5000, duration_ms: 100000));
        }

        return self::$twig->load('lyrics/lyrics_page.twig')->render(["auth" => $auth, "sources" => $sources]);
    }
}
