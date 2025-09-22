<?php

namespace Lylink\Models;

use Doctrine\ORM\Mapping as ORM;
use Lylink\DoctrineRegistry;

#[ORM\Entity]
#[ORM\Table(name: 'users')]

# Id | username | email | pasword | spotify id | allow spotify login | jellyfin account id | allow jellyfin login |||

class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    // @phpstan-ignore property.unusedType
    private int|null $id = null;

    #[ORM\Column(type: 'string')]
    public string $username;

    #[ORM\Column(type: 'string')]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string', nullable: true)]
    public string $spotifyId = "";

    #[ORM\Column(type: 'boolean')]
    public bool $allowSpotifyLogin = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    public int $jellyfinAccountId = 0;

    #[ORM\Column(type: 'boolean')]
    public bool $allowJellyfinLogin = false;

    /**
     * @return int|null
     */
    public function getId(): int | null
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function checkPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function __construct(string $email, string $username, string $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    public function __toString(): string
    {
        return $this->username;
    }

    public function updateJellyfin(string $address, string $token, bool $allow): void
    {
        $em = DoctrineRegistry::get();
        /**
         * @var JellyfinUser|null $jellyfin
         */
        $jellyfin = $em->getRepository(JellyfinUser::class)->findOneBy(['id' => $this->jellyfinAccountId]);

        if ($jellyfin == null) {
            $jellyfin = new JellyfinUser($address, $token);
        }
        $jellyfin->jellyfinAddress = $address;
        $jellyfin->jellyfinToken = $token;

        $em->persist($jellyfin);
        $em->flush();

        $this->jellyfinAccountId = $jellyfin->getId() ?? 0;
        $this->allowJellyfinLogin = $allow;
        $em->persist($this);
        $em->flush();
    }

}
