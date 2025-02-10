<?php

namespace App\Entity;

use App\Repository\EvenementsRepository;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EvenementsRepository::class)]
#[ORM\Table(name: "evenements")]
class Evenements
{
    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const MIN_LENGTH = 3;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idEvt = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Length(
        min: self::MIN_LENGTH,
        max: 255,
        minMessage: self::MIN_MESSAGE,
        maxMessage: self::MAX_MESSAGE
    )]
    private ?string $nomEvt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionEvt = null;

    #[ORM\Column(type: 'string', length: 10)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?string $typeEvt = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?int $statutEvt = null;

    #[ORM\Column(type: 'string', length: 7, nullable: true)]
    private ?string $motifEvt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?\DateTimeInterface $debutEvt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?\DateTimeInterface $finEvt = null;

    

    public function getId(): ?int
    {
        return $this->idEvt;
    }

    public function getNomEvt(): ?string
    {
        return $this->nomEvt;
    }

    public function setNomEvt(?string $nomEvt): self
    {
        $this->nomEvt = ucfirst(trim(strtolower($nomEvt)));
        return $this;
    }

    public function getDescriptionEvt(): ?string
    {
        return $this->descriptionEvt;
    }

    public function setDescriptionEvt(?string $descriptionEvt): self
    {
        $this->descriptionEvt = $descriptionEvt;
        return $this;
    }

    public function getTypeEvt(): ?string
    {
        return $this->typeEvt;
    }

    public function setTypeEvt(string $typeEvt): self
    {
        $this->typeEvt = $typeEvt;
        return $this;
    }

    public function getStatutEvt(): ?int
    {
        return $this->statutEvt;
    }

    public function setStatutEvt(int $statutEvt): self
    {
        $this->statutEvt = $statutEvt;
        return $this;
    }

    public function getMotifEvt(): ?string
    {
        return $this->motifEvt;
    }

    public function setMotifEvt(?string $motifEvt): self
    {
        $this->motifEvt = $motifEvt;
        return $this;
    }

    public function getDebutEvt(): ?\DateTimeInterface
    {
        return $this->debutEvt;
    }

    public function setDebutEvt(\DateTimeInterface $debutEvt): self
    {
        $this->debutEvt = $debutEvt;
        return $this;
    }

    public function getFinEvt(): ?\DateTimeInterface
    {
        return $this->finEvt;
    }

    public function setFinEvt(\DateTimeInterface $finEvt): self
    {
        $this->finEvt = $finEvt;
        return $this;
    }

   
}
