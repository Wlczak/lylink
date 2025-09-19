<?php

namespace Lylink\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]

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
    private string $email = "";

    #[ORM\Column(type: 'string')]
    private string $password = "";

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

}
