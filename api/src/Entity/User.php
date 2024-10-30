<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;
    #[ORM\Column]
    #[Assert\NotBlank]
    public string $firstName = '';
    #[ORM\Column]
    #[Assert\NotBlank]
    public string $lastName = '';
    #[ORM\Column]
    #[Assert\NotNull]
    public ?\DateTimeImmutable $birthDate = null;
    #[ORM\Column(nullable: true)]
    #[Assert\Email]
    public ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
