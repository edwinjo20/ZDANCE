<?php

namespace App\Entity;

use App\Repository\ProfsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProfsRepository::class)]
#[ORM\Table(name: "Profs", indexes: [new ORM\Index(name: "idx_nom_prof", columns: ["nom_prof"])])] // Index ajouté

class Profs
{
    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const EMAIL_MESSAGE = 'Veuillez entrer une adresse e-mail valide.';
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';
    private const REGEX_MESSAGE = 'Seules les lettres (y compris les accents) sont autorisées.';
    private const TEL_REGEX_MESSAGE = 'Le numéro de téléphone doit contenir uniquement des chiffres et éventuellement un "+" au début.';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'id_prof')]
    private ?int $idProf = null;

    #[ORM\Column(type: 'string', length: 100, name: 'nom_prof')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(min: self::MIN_LENGTH, max: self::MAX_LENGTH, minMessage: self::MIN_MESSAGE, maxMessage: self::MAX_MESSAGE)]
    #[Assert\Regex(pattern: '/^[\p{L}\s-]+$/u', message: self::REGEX_MESSAGE)]
    private ?string $nomProf = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(min: self::MIN_LENGTH, max: self::MAX_LENGTH, minMessage: self::MIN_MESSAGE, maxMessage: self::MAX_MESSAGE)]
    #[Assert\Regex(pattern: '/^[\p{L}\s-]+$/u', message: self::REGEX_MESSAGE)]
    private ?string $prenomProf = null;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Regex(pattern: '/^\+?\d{8,15}$/', message: self::TEL_REGEX_MESSAGE)]
    private ?string $telProf = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Email(message: self::EMAIL_MESSAGE)]
    private ?string $emailProf = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Assert\Regex(pattern: '/^\+?\d{8,15}$/', message: self::TEL_REGEX_MESSAGE)]
    private ?string $tel2Prof = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Url(message: 'Veuillez entrer une URL valide pour la photo.')]
    private ?string $photoProf = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $presentationProf = null;

    #[ORM\Column(type: 'string', name: 'index_prof', length: 30, unique: true)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?string $indexProf = null;

    /**
     * @var Collection<int, Cours>
     */
    #[ORM\OneToMany(targetEntity: Cours::class, mappedBy: 'professeur')]
    private Collection $cours;

    /**
     * @var Collection<int, Evenements>
     */
    #[ORM\OneToMany(targetEntity: Evenements::class, mappedBy: 'professeur')]
    private Collection $evenements;

 


    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->evenements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->idProf;
    }

    public function getNomProf(): ?string
    {
        return $this->nomProf;
    }

    public function setNomProf(string $nomProf): static
    {
        $this->nomProf = ucfirst(trim(strtolower($nomProf)));
        return $this;
    }

    public function getPrenomProf(): ?string
    {
        return $this->prenomProf;
    }

    public function setPrenomProf(string $prenomProf): static
    {
        $this->prenomProf = ucfirst(trim(strtolower($prenomProf)));
        return $this;
    }

    public function getEmailProf(): ?string
    {
        return $this->emailProf;
    }

    public function setEmailProf(string $emailProf): static
    {
        $this->emailProf = trim(strtolower($emailProf));
        return $this;
    }

    public function getTelProf(): ?string
    {
        return $this->telProf;
    }

    public function setTelProf(string $telProf): static
    {
        $this->telProf = trim($telProf);
        return $this;
    }

    public function getTel2Prof(): ?string
    {
        return $this->tel2Prof;
    }

    public function setTel2Prof(?string $tel2Prof): static
    {
        $this->tel2Prof = trim($tel2Prof);
        return $this;
    }

    public function getPhotoProf(): ?string
    {
        return $this->photoProf;
    }

    public function setPhotoProf(?string $photoProf): static
    {
        $this->photoProf = trim($photoProf);
        return $this;
    }

    public function getPresentationProf(): ?string
    {
        return $this->presentationProf;
    }

    public function setPresentationProf(?string $presentationProf): static
    {
        $this->presentationProf = trim($presentationProf);
        return $this;
    }

    public function getIndexProf(): ?string
    {
        return $this->indexProf;
    }

    public function setIndexProf(?string $indexProf): static
    {
        $this->indexProf = $indexProf;
        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setProfesseur($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getProfesseur() === $this) {
                $cour->setProfesseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evenements>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenements $evenement): static
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->setProfesseur($this);
        }

        return $this;
    }

    public function removeEvenement(Evenements $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getProfesseur() === $this) {
                $evenement->setProfesseur(null);
            }
        }

        return $this;
    }


   

  
}
