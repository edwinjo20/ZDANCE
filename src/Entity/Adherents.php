<?php  





namespace App\Entity;

use App\Repository\AdherentsRepository;
use Doctrine\Common\Collections\Collection;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AdherentsRepository::class)]
#[ORM\Table(name: "Adherents"
)]
#[ORM\HasLifecycleCallbacks]

class Adherents
{

    private const NOTBLANK_MESSAGE = 'Ce champ ne peut pas être vide.';
    private const EMAIL_MESSAGE = 'Veuillez entrer une adresse e-mail valide.';
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;
    private const MIN_MESSAGE = 'Vous devez entrer au moins {{ limit }} caractères.';
    private const MAX_MESSAGE = 'Vous ne pouvez pas dépasser {{ limit }} caractères.';
    private const REGEX_MESSAGE = 'Seules les lettres (y compris les accents) sont autorisées.';
    private const TEL_REGEX_MESSAGE = 'Le numéro de téléphone doit contenir uniquement des chiffres et éventuellement un "+" au début.';
    private const CP_MESSAGE = 'Le code postal doit contenir exactement 5 chiffres.';
   
   
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer',name:'id_adh')]
    private ?int $idAdh = null;

    #[ORM\Column(type:'string',length: 100)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(
        min: self::MIN_LENGTH,
        max: self::MAX_LENGTH, 
        minMessage: self::MIN_MESSAGE, 
        maxMessage: self::MAX_MESSAGE
        )]
    #[Assert\Regex(pattern: '/^[\p{L}\s-]+$/u', message: self::REGEX_MESSAGE)]
    private ?string $nomAdh = null;

    #[ORM\Column(type:'string',length: 100)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(
        min: self::MIN_LENGTH,
        max: self::MAX_LENGTH, 
        minMessage: self::MIN_MESSAGE, 
        maxMessage: self::MAX_MESSAGE
        )]
     #[Assert\Regex(pattern: '/^[\p{L}\s-]+$/u', message: self::REGEX_MESSAGE)]
    private ?string $prenomAdh = null;

    #[ORM\Column(type:'string',length: 200, nullable: true)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?string $repLegalAdh = null;

    #[ORM\Column(type:'string',length: 1,options:['default'=>'F'])]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Choice(choices: ['M', 'F'], message: "Le sexe doit être 'M' ou 'F'.")]
    private ?string $sexeAdh = null;

    #[ORM\Column(type:'string',length: 250)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Email(message: self::EMAIL_MESSAGE)]
    private ?string $emailAdh = null;

    #[ORM\Column(type:'string',length: 250, nullable: true)]
    #[Assert\Email(message: self::EMAIL_MESSAGE)]
    private ?string $email2Adh = null;

    #[ORM\Column(type:'string',length: 20)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Regex(pattern: '/^\+?\d{8,15}$/', message: self::TEL_REGEX_MESSAGE)]
    private ?string $telAdh = null;

    #[ORM\Column(type:'string',length: 20, nullable: true)]
    #[Assert\Regex(pattern: '/^\+?\d{8,15}$/', message: self::TEL_REGEX_MESSAGE)]
    private ?string $tel2Adh = null;

    #[ORM\Column(type:'string',length: 200)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?string $adrAdh = null;

    #[ORM\Column(type:'integer')]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Length(min:5, max:5, exactMessage:self::CP_MESSAGE)]
    private ?int $cpAdh = null;

    #[ORM\Column(type:'string',length: 100)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    private ?string $villeAdh = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: self::NOTBLANK_MESSAGE)]
    #[Assert\Date(message: "Veuillez entrer une date valide.")]
    private ?\DateTimeInterface $dtNaissanceAdh = null;

    #[ORM\Column(type:'string',length: 255, nullable: true)]
    private ?string $photoAdh = null;

    #[ORM\Column(type:'string',length: 4, nullable: true)]
    private ?string $passSanitaireAdh = null;


// Supprimez la colonne index_adh redondante (optionnel)
// Gardez cette ligne si vous voulez stocker une copie locale :
#[ORM\Column(type: 'string', length: 30, nullable: true)]
private ?string $indexAdh = null;

/**
 * @var Collection<int, AdInscriptionPaiement>
 */
#[ORM\OneToMany(targetEntity: AdInscriptionPaiement::class, mappedBy: 'adherent')]
private Collection $adInscriptionPaiements;

   
     /**
     * Relation avec la table EvtPresence (OneToMany)
     */

    public function __construct()
    {
        $this->sexeAdh = "F";

    }

    public function getId(): ?int
    {
        return $this->idAdh;
    }

    public function getNomAdh(): ?string
    {
        return $this->nomAdh;
    }

    public function setNomAdh(string $nomAdh): static
    {
        $this->nomAdh = ucfirst(trim(strtolower($nomAdh)));

        return $this;
    }

    public function getPrenomAdh(): ?string
    {
        return $this->prenomAdh;
    }

    public function setPrenomAdh(string $prenomAdh): static
    {
        $this->prenomAdh = ucfirst(trim(strtolower($prenomAdh)));

        return $this;
    }

    public function getRepLegalAdh(): ?string
    {
        return $this->repLegalAdh;
    }

    public function setRepLegalAdh(?string $repLegalAdh): static
    {
        $this->repLegalAdh = $repLegalAdh;

        return $this;
    }

    public function getSexeAdh(): ?string
    {
        return $this->sexeAdh;
    }

    public function setSexeAdh(string $sexeAdh): static
    {
        $this->sexeAdh = trim(strtoupper($sexeAdh));

        return $this;
    }

    public function getEmailAdh(): ?string
    {
        return $this->emailAdh;
    }

    public function setEmailAdh(string $emailAdh): static
    {
        $this->emailAdh = trim(strtolower($emailAdh));

        return $this;
    }

    public function getEmail2Adh(): ?string
    {
        return $this->email2Adh;
    }

    public function setEmail2Adh(?string $email2Adh): static
    {
        $this->email2Adh = trim(strtolower($email2Adh));

        return $this;
    }

    public function getTelAdh(): ?string
    {
        return $this->telAdh;
    }

    public function setTelAdh(string $telAdh): static
    {
        $this->telAdh = trim($telAdh);

        return $this;
    }

    public function getTel2Adh(): ?string
    {
        return $this->tel2Adh;
    }

    public function setTel2Adh(?string $tel2Adh): static
    {
        $this->tel2Adh = trim($tel2Adh);

        return $this;
    }

    public function getAdrAdh(): ?string
    {
        return $this->adrAdh;
    }

    public function setAdrAdh(string $adrAdh): static
    {
        $this->adrAdh = trim($adrAdh);

        return $this;
    }

    public function getCpAdh(): ?int
    {
        return $this->cpAdh;
    }

    public function setCpAdh(int $cpAdh): static
    {
        $this->cpAdh = trim($cpAdh);

        return $this;
    }

    public function getVilleAdh(): ?string
    {
        return $this->villeAdh;
    }

    public function setVilleAdh(string $villeAdh): static
    {
        $this->villeAdh = trim(strtolower($villeAdh));

        return $this;
    }

    public function getDtNaissanceAdh(): ?\DateTimeInterface
    {
        return $this->dtNaissanceAdh;
    }

    public function setDtNaissanceAdh(\DateTimeInterface $dtNaissanceAdh): static
    {
        $this->dtNaissanceAdh = $dtNaissanceAdh;

        return $this;
    }

    public function getPhotoAdh(): ?string
    {
        return $this->photoAdh;
    }

    public function setPhotoAdh(?string $photoAdh): static
    {
        $this->photoAdh = trim($photoAdh);

        return $this;
    }

    public function getPassSanitaireAdh(): ?string
    {
        return $this->passSanitaireAdh;
    }

    public function setPassSanitaireAdh(?string $passSanitaireAdh): static
    {
        $this->passSanitaireAdh = trim(strtolower($passSanitaireAdh));

        return $this;
    }

    public function getIndexAdh(): ?string
    {
        return $this->indexAdh;
    }

    public function setIndexAdh(?string $indexAdh): static
    {
        $this->indexAdh = $indexAdh;
        return $this;
    }

}
