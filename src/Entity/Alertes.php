<?php

namespace App\Entity;

use App\Repository\AlertesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AlertesRepository::class)]
#[ORM\Table(name: "Alertes")]
class Alertes
{

    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';
    private const REGEX_MESSAGE = 'Seules les lettres (y compris les accents) sont autorisées.';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer',name:'id_alt')]
    private ?int $idAlt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?\DateTimeInterface $dtAlt = null;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?string $typeAlt = null;

    #[ORM\Column(type: 'string', length: 1, options: ['default' => 'N'])]
    private ?string $statutAlt = 'N';

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private ?bool $hideAlt = false;

    #[ORM\ManyToOne(targetEntity: Admins::class,inversedBy: "alertes")]
    #[ORM\JoinColumn(name: "admin_index_alt", referencedColumnName: "id_adm", nullable: false)]
    private ?Admins $adminIndexAlt = null;

    #[ORM\Column()]
    private ?string $origineAlt = null;

    #[ORM\ManyToOne(targetEntity: Profs::class,inversedBy: "alertes")]
    #[ORM\JoinColumn(name: "prof_index_alt", referencedColumnName: "id_prof", nullable: true)]
    private ?Profs $profIndexAlt = null;

// Dans Alertes.php, ajoutez l'inversedBy si nécessaire
#[ORM\ManyToOne(targetEntity: Adherents::class, inversedBy: "alertes")]
#[ORM\JoinColumn(name: "adh_index_alt", referencedColumnName: "id_adh", nullable: true)]
private ?Adherents $adhIndexAlt = null;



    public function __constructl()
    {
        ;
        $this->statutAlt = "N";
        $this->hideAlt = false;
    }

    public function getId(): ?int
    {
        return $this->idAlt;
    }

    public function getDtAlt(): ?\DateTimeInterface
    {
        return $this->dtAlt;
    }

    public function setDtAlt(\DateTimeInterface $dtAlt): self
    {
        $this->dtAlt = $dtAlt;
        return $this;
    }

    public function getTypeAlt(): ?string
    {
        return $this->typeAlt;
    }

    public function setTypeAlt(string $typeAlt): self
    {
        $this->typeAlt = $typeAlt;
        return $this;
    }

    public function getStatutAlt(): ?string
    {
        return $this->statutAlt;
    }

    public function setStatutAlt(string $statutAlt): self
    {
        $this->statutAlt = $statutAlt;
        return $this;
    }

    public function isHideAlt(): ?bool
    {
        return $this->hideAlt;
    }

    public function setHideAlt(bool $hideAlt): self
    {
        $this->hideAlt = $hideAlt;
        return $this;
    }

    
}
