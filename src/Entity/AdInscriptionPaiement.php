<?php

namespace App\Entity;

use App\Repository\AdInscriptionPaiementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'Adh_Inscription_Paiement')]
#[ORM\Entity(repositoryClass: AdInscriptionPaiementRepository::class)]
class AdInscriptionPaiement
{
    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 50;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Range(min: 2000, max: 2100, notInRangeMessage: "L'année doit être comprise entre {{ min }} et {{ max }}.")]
    private ?int $annee = null;

    #[ORM\ManyToOne(inversedBy: 'adInscriptionPaiements')]
    #[ORM\JoinColumn(name: 'id_adh', referencedColumnName: 'id_adh', nullable: false)]
    private ?Adherents $adherent = null;

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?int $numChAdh = null;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Assert\Length(min: self::MIN_LENGTH, max: self::MAX_LENGTH, minMessage: self::MIN_MESSAGE, maxMessage: self::MAX_MESSAGE)]
    private ?string $banqueChAdh = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Date(message: 'Veuillez entrer une date valide.')]
    private ?\DateTimeInterface $dateChAdh = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\PositiveOrZero(message: 'Le montant ne peut pas être négatif.')]
    private ?string $montantChAdh = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $isPaid = false;

    public function __construct(Adherents $adherent, int $numChAdh)
    {
        $this->adherent = $adherent;
        $this->numChAdh = $numChAdh;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getAdherent(): ?Adherents
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherents $adherent): static
    {
        $this->adherent = $adherent;

        return $this;
    }

    public function getNumChAdh(): ?int
    {
        return $this->numChAdh;
    }

    public function setNumChAdh(int $numChAdh): self
    {
        $this->numChAdh = $numChAdh;

        return $this;
    }

    public function getBanqueChAdh(): ?string
    {
        return $this->banqueChAdh;
    }

    public function setBanqueChAdh(?string $banqueChAdh): self
    {
        $this->banqueChAdh = trim(strtoupper($banqueChAdh));

        return $this;
    }

    public function getDateChAdh(): ?\DateTimeInterface
    {
        return $this->dateChAdh;
    }

    public function setDateChAdh(\DateTimeInterface $dateChAdh): self
    {
        $this->dateChAdh = $dateChAdh;

        return $this;
    }

    public function getMontantChAdh(): ?float
    {
        return $this->montantChAdh;
    }

    public function setMontantChAdh(float $montantChAdh): self
    {
        $this->montantChAdh = $montantChAdh;

        return $this;
    }

    public function isPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }
}
