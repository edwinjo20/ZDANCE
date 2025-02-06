<?php

namespace App\Entity;

use App\Repository\SettingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
#[ORM\Table(name: "Setting")]

class Setting
{
    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const EMAIL_MESSAGE = 'Veuillez entrer une adresse e-mail valide.';

    private const MIN_LENGTH = 2;
    private const MAX_LENGTH = 100;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer')]
    private ?int $id = null;

    #[ORM\Column(type:'string',length: 100,unique:true)]
    #[Assert\Length(min: self::MIN_LENGTH, max: self::MAX_LENGTH, minMessage: self::MIN_MESSAGE, maxMessage: self::MAX_MESSAGE)]
    #[Assert\Email(message:self::EMAIL_MESSAGE)]
    #[NotBlank(
        message:self::NOTBLANK_MESSAGE
    )]
    private ?string $email = null;

    #[ORM\Column(type:'integer')]
    private ?int $activeYear = null;

    private function __construct()
    {
        $this->activeYear = (int) date('Y');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = trim(strtolower($email));

        return $this;
    }

    public function getActiveYear(): ?int
    {
        return $this->activeYear;
    }

    public function setActiveYear(int $activeYear): static
    {
        $this->activeYear = $activeYear;

        return $this;
    }
}
