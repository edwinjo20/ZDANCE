<?php

namespace App\Entity;

use App\Repository\FormuleInscriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormuleInscriptionRepository::class)]
#[ORM\Table(name: "formule_inscription")]
#[UniqueEntity(fields: ['codeF'], message: "Ce code existe déjà.")]
class FormuleInscription
{
    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';
    private const POSITIVE_MESSAGE = 'La valeur doit être positive.';

    #[ORM\Id]
    #[ORM\Column(type: 'integer',name:'annee')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Range(min: 2000, max: 2100, notInRangeMessage: "L'année doit être comprise entre {{ min }} et {{ max }}.")]
    private ?int $annee = null;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 4, unique:true)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(min: 2, max: 4, minMessage: self::MIN_MESSAGE, maxMessage: self::MAX_MESSAGE)]
    private ?string $codeF = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(min: 3, max: 100, minMessage: self::MIN_MESSAGE, maxMessage: self::MAX_MESSAGE)]
    private ?string $libelleF = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Positive(message: self::POSITIVE_MESSAGE)]
    private ?int $tarifF = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\PositiveOrZero(message: self::POSITIVE_MESSAGE)]
    private ?int $tarifRenew = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\PositiveOrZero(message: self::POSITIVE_MESSAGE)]
    private ?int $ageMinF = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\PositiveOrZero(message: self::POSITIVE_MESSAGE)]
    private ?int $ageMaxF = null;

    public function __construct()
    {
        $this->annee = (int) date('Y'); // Par défaut, année actuelle
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): static
    {
        $this->annee = $annee;
        return $this;
    }

    public function getCodeF(): ?string
    {
        return $this->codeF;
    }

    public function setCodeF(string $codeF): static
    {
        $this->codeF = strtoupper(trim($codeF));
        return $this;
    }

    public function getLibelleF(): ?string
    {
        return $this->libelleF;
    }

    public function setLibelleF(string $libelleF): static
    {
        $this->libelleF = ucfirst(trim($libelleF));
        return $this;
    }

    public function getTarifF(): ?int
    {
        return $this->tarifF;
    }

    public function setTarifF(int $tarifF): static
    {
        $this->tarifF = $tarifF;
        return $this;
    }

    public function getTarifRenew(): ?int
    {
        return $this->tarifRenew;
    }

    public function setTarifRenew(?int $tarifRenew): static
    {
        $this->tarifRenew = $tarifRenew;
        return $this;
    }

    public function getAgeMinF(): ?int
    {
        return $this->ageMinF;
    }

    public function setAgeMinF(?int $ageMinF): static
    {
        $this->ageMinF = $ageMinF;
        return $this;
    }

    public function getAgeMaxF(): ?int
    {
        return $this->ageMaxF;
    }

    public function setAgeMaxF(?int $ageMaxF): static
    {
        $this->ageMaxF = $ageMaxF;
        return $this;
    }
}
