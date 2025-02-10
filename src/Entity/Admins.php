<?php

namespace App\Entity;

use App\Repository\AdminsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: AdminsRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'Admins')]
class Admins
{

    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';
    private const REGEX_MESSAGE = 'Seules les lettres (y compris les accents) sont autorisées.';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer',name:'id_adm')]
    private ?int $idAdm = null;

    #[ORM\Column(type:'string',length: 100)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(min: self::MIN_LENGTH, max: self::MAX_LENGTH, minMessage: self::MIN_MESSAGE, maxMessage: self::MAX_MESSAGE)]
    #[Assert\Regex(pattern: '/^[\p{L}\s-]+$/u', message: self::REGEX_MESSAGE)]
    private ?string $nomAdm = null;

    #[ORM\Column(type:'string',length: 100)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(min: self::MIN_LENGTH, max: self::MAX_LENGTH, minMessage: self::MIN_MESSAGE, maxMessage: self::MAX_MESSAGE)]
    #[Assert\Regex(pattern: '/^[\p{L}\s-]+$/u', message: self::REGEX_MESSAGE)]
    private ?string $prenomAdm = null;

    #[ORM\Column(type:'string',length: 255, nullable: true)]
    private ?string $signatureAdm = null;

    #[ORM\Column(type: 'string',name:'index_adm', length: 30, unique: true)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?string $indexAdm = null;


    public function __construct()
    {

    }

   
    public function getId(): ?int
    {
        return $this->idAdm;
    }

    public function getNomAdm(): ?string
    {
        return $this->nomAdm;
    }

    public function setNomAdm(string $nomAdm): static
    {
        $this->nomAdm = ucfirst(trim(strtolower($nomAdm)));

        return $this;
    }

    public function getPrenomAdm(): ?string
    {
        return $this->prenomAdm;
    }

    public function setPrenomAdm(string $prenomAdm): static
    {
        $this->prenomAdm = ucfirst(trim(strtolower($prenomAdm)));

        return $this;
    }

    public function getSignatureAdm(): ?string
    {
        return $this->signatureAdm;
    }

    public function setSignatureAdm(?string $signatureAdm): static
    {
        $this->signatureAdm = trim(strtolower($signatureAdm));

        return $this;
    }

    public function getIndexAdm(): ?string
    {
        return $this->indexAdm;
    }

    public function setIndexAdm(?string $indexAdm): static
    {
        $this->indexAdm = $indexAdm;
        return $this;
    }


}
