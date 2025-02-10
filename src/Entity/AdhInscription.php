<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\AdInscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AdInscriptionRepository::class)]
#[ORM\Table(name: "Adh_Inscription")]
class AdInscription
{
    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';

 

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Range(min: 2000, max: 2100, notInRangeMessage: "L'année doit être comprise entre {{ min }} et {{ max }}.")]
    private ?int $annee = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $bulletinAdh = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $certifAdh = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $attestationCeAdh = false;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?\DateTimeImmutable $dtInscriptionAdh = null;

    #[ORM\Column(type: 'string', length: 4, nullable: true)]
    private ?string $formuleAdh = null;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    #[Assert\PositiveOrZero]
    private ?int $nbRenewCardAdh = 0;

    #[ORM\Column(type: 'string', length: 3, nullable: true)]
    #[Assert\Choice(choices: ['CB', 'CHQ', 'VIR', 'ESP'], message: "Mode de paiement invalide.")]
    private ?string $modePaiementAdh = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, options: ['default' => 0.00])]
    #[Assert\PositiveOrZero]
    private ?float $remiseAdh = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, nullable: true)]
    #[Assert\PositiveOrZero]
    private ?float $montantTotalAdh = 0.00;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, options: ['default' => 0.00])]
    #[Assert\PositiveOrZero]
    private ?float $montantPayeAdh = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, nullable: true)]
    #[Assert\PositiveOrZero]
    private ?float $cautionAdh = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $isPayeAdh = false;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $noteAdh = null;

    public function __construct( int $annee)
    {
        $this->annee = $annee;
        $this->dtInscriptionAdh = new \DateTimeImmutable();
        $this->attestationCeAdh = false;
        $this->nbRenewCardAdh = 0;
        $this->remiseAdh = 0.00;
        $this->montantPayeAdh = 0.00;
        $this->isPayeAdh = false;
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

    public function getBulletinAdh(): ?string
    {
        return $this->bulletinAdh;
    }

    public function setBulletinAdh(?string $bulletinAdh): self
    {
        $this->bulletinAdh = $bulletinAdh;
        return $this;
    }

    public function getCertifAdh(): ?string
    {
        return $this->certifAdh;
    }

    public function setCertifAdh(?string $certifAdh): self
    {
        $this->certifAdh = $certifAdh;
        return $this;
    }

    public function isAttestationCeAdh(): ?bool
    {
        return $this->attestationCeAdh;
    }

    public function setAttestationCeAdh(bool $attestationCeAdh): self
    {
        $this->attestationCeAdh = $attestationCeAdh;
        return $this;
    }

    public function getDtInscriptionAdh(): ?\DateTimeImmutable
    {
        return $this->dtInscriptionAdh;
    }

    public function setDtInscriptionAdh(\DateTimeImmutable $dtInscriptionAdh): self
    {
        $this->dtInscriptionAdh = $dtInscriptionAdh;
        return $this;
    }


    public function getFormuleAdh(): ?float
    {
        return $this->formuleAdh;
    }

    public function setFormuleAdh(?float $formuleAdh): self
    {
        $this->formuleAdh = $formuleAdh;
        return $this;
    }

    public function getNbReneWCardAdh(): ?float
    {
        return $this->nbRenewCardAdh;
    }

    public function setNbReneWCardAdh(?float $nbRenewCardAdh): self
    {
        $this->nbRenewCardAdh = $nbRenewCardAdh;
        return $this;
    }

    public function getModePaiementAdh(): ?float
    {
        return $this->modePaiementAdh;
    }

    public function setModePaiementAdh(float $modePaiementAdh): self
    {
        $this->modePaiementAdh = $modePaiementAdh;
        return $this;
    }


    public function getRemiseAdh(): ?float
    {
        return $this->remiseAdh;
    }

    public function setRemiseAdh(float $remiseAdh): self
    {
        $this->remiseAdh = $remiseAdh;
        return $this;
    }

    public function getMontantTotalAdh(): ?float
    {
        return $this->montantTotalAdh;
    }

    public function setMontantTotalAdh(float $montantTotalAdh): self
    {
        $this->montantTotalAdh = $montantTotalAdh;
        return $this;
    }

    public function getMontantPayeAdh(): ?float
    {
        return $this->montantPayeAdh;
    }

    public function setMontantPayeAdh(float $montantPayeAdh): self
    {
        $this->montantPayeAdh = $montantPayeAdh;
        return $this;
    }

    public function getCautionAdh(): ?float
    {
        return $this->cautionAdh;
    }

    public function setCautionAdh(?float $cautionAdh): self
    {
        $this->cautionAdh = $cautionAdh;
        return $this;
    }

    public function isPayeAdh(): ?bool
    {
        return $this->isPayeAdh;
    }

    public function setIsPayeAdh(bool $isPayeAdh): self
    {
        $this->isPayeAdh = $isPayeAdh;
        return $this;
    }

    public function getNoteAdh(): ?string
    {
        return $this->noteAdh;
    }

    public function setNoteAdh(?string $noteAdh): self
    {
        $this->noteAdh = $noteAdh;
        return $this;
    }
}
