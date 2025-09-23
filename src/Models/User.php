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
        $settings = Settings::getSettings($this);

        if ($settings == null) {
            $settings = new Settings($this);
        }
        $settings->jellyfin_server = $address;
        $settings->jellyfin_token = $token;
        $settings->jellyfin_user_id = null;
        $settings->allow_jellyfin_login = $allow;

        $em->persist($settings);
        $em->flush();
    }

}
