<?php

namespace App\Entity;

use App\Repository\SallesRepository;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SallesRepository::class)]
#[ORM\Table(name: "Salles")]

class Salles
{
    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';
    private const REGEX_MESSAGE = 'Seules les lettres (y compris les accents) sont autorisées.';
    private const CP_REGEX_MESSAGE = 'Le code postal doit contenir exactement 5 chiffres.';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'id_salle')]
    private ?int $idSalle = null;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(min: self::MIN_LENGTH, max: self::MAX_LENGTH, minMessage: self::MIN_MESSAGE, maxMessage: self::MAX_MESSAGE)]
    #[Assert\Regex(pattern: '/^[\p{L}\s-]+$/u', message: self::REGEX_MESSAGE)]
    private ?string $nomSalle = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $quotaSalle = null;

    #[ORM\Column(type: 'string', length: 200)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(min: self::MIN_LENGTH, max: 200, minMessage: self::MIN_MESSAGE, maxMessage: self::MAX_MESSAGE)]
    private ?string $adrSalle = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Regex(pattern: '/^\d{5}$/', message: self::CP_REGEX_MESSAGE)]
    private ?int $cpSalle = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?string $villeSalle = null;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private ?string $indicationSalle = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Url(message: 'Veuillez entrer une URL valide pour la carte.')]
    private ?string $carteSalle = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Url(message: 'Veuillez entrer une URL valide pour la photo.')]
    private ?string $photoSalle = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $isActive = false;


    public function getId(): ?int
    {
        return $this->idSalle;
    }

    public function getNomSalle(): ?string
    {
        return $this->nomSalle;
    }

    public function setNomSalle(string $nomSalle): self
    {
        $this->nomSalle = ucfirst(trim(strtolower($nomSalle)));
        return $this;
    }

    public function getQuotaSalle(): ?int
    {
        return $this->quotaSalle;
    }

    public function setQuotaSalle(?int $quotaSalle): self
    {
        $this->quotaSalle = $quotaSalle;
        return $this;
    }

    public function getAdrSalle(): ?string
    {
        return $this->adrSalle;
    }

    public function setAdrSalle(string $adrSalle): self
    {
        $this->adrSalle = trim($adrSalle);
        return $this;
    }

    public function getCpSalle(): ?int
    {
        return $this->cpSalle;
    }

    public function setCpSalle(int $cpSalle): self
    {
        $this->cpSalle = $cpSalle;
        return $this;
    }

    public function getVilleSalle(): ?string
    {
        return $this->villeSalle;
    }

    public function setVilleSalle(string $villeSalle): self
    {
        $this->villeSalle = ucfirst(trim(strtolower($villeSalle)));
        return $this;
    }

    public function getIndicationSalle(): ?string
    {
        return $this->indicationSalle;
    }

    public function setIndicationSalle(?string $indicationSalle): self
    {
        $this->indicationSalle = trim($indicationSalle);
        return $this;
    }

    public function getCarteSalle(): ?string
    {
        return $this->carteSalle;
    }

    public function setCarteSalle(?string $carteSalle): self
    {
        $this->carteSalle = trim($carteSalle);
        return $this;
    }

    public function getPhotoSalle(): ?string
    {
        return $this->photoSalle;
    }

    public function setPhotoSalle(?string $photoSalle): self
    {
        $this->photoSalle = trim($photoSalle);
        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

}
