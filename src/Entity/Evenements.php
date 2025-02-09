<?php

namespace App\Entity;

use App\Repository\EvenementsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementsRepository::class)]
#[ORM\Table(name:'Evenements')]
class Evenements
{


    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const MIN_LENGTH = 3;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer',name:'id_evt')]
    private ?int $idEvt = null;

    #[ORM\Column(type:'string',length: 255, nullable: true)]
    private ?string $nomEvt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionEvt = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $typeEvt = null;

    #[ORM\Column('integer')]
    private ?int $statutEvt = 0;

    #[ORM\Column(length: 7, nullable: true)]
    private ?string $motifEvt = null;

    #[ORM\ManyToOne(targetEntity:Profs::class,inversedBy: 'evenements')]
    #[ORM\JoinColumn(name: "id_prof_evt", referencedColumnName: "id_prof", nullable: false)]
    private ?Profs $professeur = null;

    #[ORM\ManyToOne(targetEntity:Cours::class,inversedBy: 'evenements')]
    #[ORM\JoinColumn(name: "id_cours_evt", referencedColumnName: "id_cours", nullable: false, onDelete: "RESTRICT")]
    private ?Cours $cours = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $debutEvt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $finEvt = null;

    public function getId(): ?int
    {
        return $this->idEvt;
    }

    public function getNomEvt(): ?string
    {
        return $this->nomEvt;
    }

    public function setNomEvt(?string $nomEvt): static
    {
        $this->nomEvt = $nomEvt;

        return $this;
    }

    public function getDescriptionEvt(): ?string
    {
        return $this->descriptionEvt;
    }

    public function setDescriptionEvt(?string $descriptionEvt): static
    {
        $this->descriptionEvt = $descriptionEvt;

        return $this;
    }

    public function getTypeEvt(): ?string
    {
        return $this->typeEvt;
    }

    public function setTypeEvt(string $typeEvt): static
    {
        $this->typeEvt = $typeEvt;

        return $this;
    }

    public function getStatutEvt(): ?int
    {
        return $this->statutEvt;
    }

    public function setStatutEvt(int $statutEvt): static
    {
        $this->statutEvt = $statutEvt;

        return $this;
    }

    public function getMotifEvt(): ?string
    {
        return $this->motifEvt;
    }

    public function setMotifEvt(?string $motifEvt): static
    {
        $this->motifEvt = $motifEvt;

        return $this;
    }

    public function getProfesseur(): ?Profs
    {
        return $this->professeur;
    }

    public function setProfesseur(?Profs $professeur): static
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): static
    {
        $this->cours = $cours;

        return $this;
    }

    public function getDebutEvt(): ?\DateTimeInterface
    {
        return $this->debutEvt;
    }

    public function setDebutEvt(\DateTimeInterface $debutEvt): static
    {
        $this->debutEvt = $debutEvt;

        return $this;
    }

    public function getFinEvt(): ?\DateTimeInterface
    {
        return $this->finEvt;
    }

    public function setFinEvt(\DateTimeInterface $finEvt): static
    {
        $this->finEvt = $finEvt;

        return $this;
    }
}
