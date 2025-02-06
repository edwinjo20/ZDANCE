<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
#[ORM\Table(name: "Cours")]

class Cours
{
    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer',name:'id_cours')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Salles::class, inversedBy: 'cours')]
    #[ORM\JoinColumn(name: 'id_salle', referencedColumnName: 'id_salle', nullable: false)]  
    private ?Salles $salles = null;

    #[ORM\ManyToOne(targetEntity: Profs::class, inversedBy: 'cours')]
    #[ORM\JoinColumn(name: 'id_prof', referencedColumnName: 'id_prof', nullable: false)]
    private ?Profs $professeur = null;

    #[ORM\ManyToOne(targetEntity: Disciplines::class, inversedBy: 'cours')]
    #[ORM\JoinColumn(name: 'id_discipline', referencedColumnName: 'id_discipline', nullable: false)]  
    private ?Disciplines $discipline = null;


    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?int $anneeCours = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Range(min: 1, max: 7, notInRangeMessage: "Le jour doit être compris entre {{ min }} et {{ max }}.")]
    private ?int $jourCours = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?int $heureCours = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Positive(message: "La durée doit être un nombre positif.")]
    private ?int $dureeCours = 60;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\PositiveOrZero(message: "L'âge minimum ne peut pas être négatif.")]
    private ?int $ageMinCours = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\PositiveOrZero(message: "L'âge maximum ne peut pas être négatif.")]
    private ?int $ageMaxCours = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $isActive = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $isFull = false;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $isPopulated = false;

    /**
     * @var Collection<int, AdhCours>
     */
    #[ORM\ManyToMany(targetEntity: AdhCours::class, mappedBy: 'adherent')]
    private Collection $adhCours;

    



    public function __construct()
    {
        $this->anneeCours = (int) date('Y');
        $this->dureeCours = 60;
        $this->isActive = false;
        $this->isFull = false;
        $this->isPopulated = false;
        $this->adhCours = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeCours(): ?int
    {
        return $this->anneeCours;
    }

    public function setAnneeCours(int $anneeCours): self
    {
        $this->anneeCours = $anneeCours;
        return $this;
    }

    public function getJourCours(): ?int
    {
        return $this->jourCours;
    }

    public function setJourCours(int $jourCours): self
    {
        $this->jourCours = $jourCours;
        return $this;
    }

    public function getHeureCours(): ?string
    {
        return $this->heureCours;
    }

    public function setHeureCours(string $heureCours): self
    {
        $this->heureCours = $heureCours;
        return $this;
    }

    public function getDureeCours(): ?int
    {
        return $this->dureeCours;
    }

    public function setDureeCours(int $dureeCours): self
    {
        $this->dureeCours = $dureeCours;
        return $this;
    }

    public function getAgeMinCours(): ?int
    {
        return $this->ageMinCours;
    }

    public function setAgeMinCours(?int $ageMinCours): self
    {
        $this->ageMinCours = $ageMinCours;
        return $this;
    }

    public function getAgeMaxCours(): ?int
    {
        return $this->ageMaxCours;
    }

    public function setAgeMaxCours(?int $ageMaxCours): self
    {
        $this->ageMaxCours = $ageMaxCours;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function isFull(): bool
    {
        return $this->isFull;
    }

    public function setIsFull(bool $isFull): self
    {
        $this->isFull = $isFull;
        return $this;
    }

    public function isPopulated(): bool
    {
        return $this->isPopulated;
    }

    public function setIsPopulated(bool $isPopulated): self
    {
        $this->isPopulated = $isPopulated;
        return $this;
    }

    public function getSalles(): ?Salles
    {
        return $this->salles;
    }

    public function setSalles(?Salles $salles): static
    {
        $this->salles = $salles;

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

    public function getDiscipline(): ?Disciplines
    {
        return $this->discipline;
    }

    public function setDiscipline(?Disciplines $discipline): static
    {
        $this->discipline = $discipline;

        return $this;
    }

    /**
     * @return Collection<int, AdhCours>
     */
    public function getAdhCours(): Collection
    {
        return $this->adhCours;
    }

    public function addAdhCour(AdhCours $adhCour): static
    {
        if (!$this->adhCours->contains($adhCour)) {
            $this->adhCours->add($adhCour);
            $adhCour->addAdherent($this);
        }

        return $this;
    }

    public function removeAdhCour(AdhCours $adhCour): static
    {
        if ($this->adhCours->removeElement($adhCour)) {
            $adhCour->removeAdherent($this);
        }

        return $this;
    }

}
