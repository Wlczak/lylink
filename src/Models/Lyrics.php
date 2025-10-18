<?php

namespace Lylink\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'lyrics')]

class Lyrics
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    // @phpstan-ignore property.unusedType
    private int|null $id = null;

    #[ORM\Column(type: 'string', nullable: true)]
    public string $spotify_id = "";

    #[ORM\Column(type: 'string')]
    public string $lyrics = "";

    #[ORM\Column(type: 'string', nullable: true)]
    public string $jellyfin_show_id = "";

    #[ORM\Column(type: 'integer', nullable: true)]
    public int $jellyfin_season_number = 0;

    #[ORM\Column(type: 'integer')]
    public int $jellyfin_start_episode_number = 0;

    #[ORM\Column(type: 'integer')]
    public int $jellyfin_end_episode_number = 0;

    /**
     * @return int|null
     */
    public function getId(): int | null
    {
        return $this->id;
    }
}
