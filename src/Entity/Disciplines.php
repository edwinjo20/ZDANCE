<?php

namespace App\Entity;

use App\Repository\DisciplinesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity('nomDiscipline', message: self::UNIQUEENTITY)]
#[ORM\Entity(repositoryClass: DisciplinesRepository::class)]
#[ORM\Table(name: "Disciplines")]

class Disciplines
{

    private const UNIQUEENTITY = '{{ value }} est déjà enregistré.';
    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';
    private const REGEX_MESSAGE = 'Seules les lettres (y compris les accents) sont autorisées.';


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'id_discipline')]
    private ?int $idDiscipline = null;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(
        min: self::MIN_LENGTH,
        max: self::MAX_LENGTH,
        minMessage: self::MIN_MESSAGE,
        maxMessage: self::MAX_MESSAGE
    )]
    #[Assert\Regex(
        pattern: '/^[\p{L}\s-]+$/u',
        message: self::REGEX_MESSAGE
    )]  
    private ?string $nomDiscipline = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        min: 10,
        max: 1000,
        minMessage: "La description doit contenir au moins {{ limit }} caractères.",
        maxMessage: "La description ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $descriptionDiscipline = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Url(message: 'L’URL de la photo n’est pas valide.')]
    private ?string $photoDiscipline = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Url(message: 'L’URL de la vidéo n’est pas valide.')]
    private ?string $videoDiscipline = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $isActive = false;


    public function __construct()
    {
        $this->isActive = false;
    }

    public function getId(): ?int
    {
        return $this->idDiscipline;
    }

    public function getNomDiscipline(): ?string
    {
        return $this->nomDiscipline;
    }

    public function setNomDiscipline(string $nomDiscipline): self
    {
        $this->nomDiscipline = ucfirst(trim(strtolower($nomDiscipline))); // Capitalisation de la première lettre
        return $this;
    }

    public function getDescriptionDiscipline(): ?string
    {
        return $this->descriptionDiscipline;
    }

    public function setDescriptionDiscipline(?string $descriptionDiscipline): self
    {
        $this->descriptionDiscipline = trim($descriptionDiscipline);
        return $this;
    }

    public function getPhotoDiscipline(): ?string
    {
        return $this->photoDiscipline;
    }

    public function setPhotoDiscipline(?string $photoDiscipline): self
    {
        $this->photoDiscipline = $photoDiscipline ? trim(strtolower($photoDiscipline)) : null;
        return $this;
    }

    public function getVideoDiscipline(): ?string
    {
        return $this->videoDiscipline;
    }

    public function setVideoDiscipline(?string $videoDiscipline): self
    {
        $this->videoDiscipline = $videoDiscipline ? trim(strtolower($videoDiscipline)) : null;
        return $this;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {   
        $this->isActive = $isActive;
        return $this;
    }
}
