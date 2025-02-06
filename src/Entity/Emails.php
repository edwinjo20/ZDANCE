<?php

namespace App\Entity;

use App\Repository\EmailsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

#[ORM\Entity(repositoryClass: EmailsRepository::class)]
#[Table('Emails')]
class Emails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer',name:'id_email')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fromEmail = null;

    #[ORM\Column(length: 30, nullable:true)]
    private ?string $fromAdhindexEmail = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $fromProfIndexEmail = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $toEmail = null;

    #[ORM\Column(length: 8)]
    private ?string $toTypeEmail = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $adhIndexEmail = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $profIndexEmail = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $coursIdEmail = null;

    #[ORM\Column(length: 255)]
    private ?string $toNameEmail = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dtEmail = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $subjectEmail = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contentEmail = null;

    public function __construct( )
    {


    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromEmail(): ?string
    {
        return $this->fromEmail;
    }

    public function setFromEmail(string $fromEmail): static
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    public function getFromAdhindexEmail(): ?string
    {
        return $this->fromAdhindexEmail;
    }

    public function setFromAdhindexEmail(string $fromAdhindexEmail): static
    {
        $this->fromAdhindexEmail = $fromAdhindexEmail;

        return $this;
    }

    public function getFromProfIndexEmail(): ?string
    {
        return $this->fromProfIndexEmail;
    }

    public function setFromProfIndexEmail(?string $fromProfIndexEmail): static
    {
        $this->fromProfIndexEmail = $fromProfIndexEmail;

        return $this;
    }

    public function getToEmail(): ?string
    {
        return $this->toEmail;
    }

    public function setToEmail(string $toEmail): static
    {
        $this->toEmail = $toEmail;

        return $this;
    }

    public function getToTypeEmail(): ?string
    {
        return $this->toTypeEmail;
    }

    public function setToTypeEmail(string $toTypeEmail): static
    {
        $this->toTypeEmail = $toTypeEmail;

        return $this;
    }

    public function getAdhIndexEmail(): ?string
    {
        return $this->adhIndexEmail;
    }

    public function setAdhIndexEmail(?string $adhIndexEmail): static
    {
        $this->adhIndexEmail = $adhIndexEmail;

        return $this;
    }

    public function getProfIndexEmail(): ?string
    {
        return $this->profIndexEmail;
    }

    public function setProfIndexEmail(?string $profIndexEmail): static
    {
        $this->profIndexEmail = $profIndexEmail;

        return $this;
    }

    public function getCoursIdEmail(): ?string
    {
        return $this->coursIdEmail;
    }

    public function setCoursIdEmail(?string $coursIdEmail): static
    {
        $this->coursIdEmail = $coursIdEmail;

        return $this;
    }

    public function getToNameEmail(): ?string
    {
        return $this->toNameEmail;
    }

    public function setToNameEmail(string $toNameEmail): static
    {
        $this->toNameEmail = $toNameEmail;

        return $this;
    }

    public function getDtEmail(): ?\DateTimeInterface
    {
        return $this->dtEmail;
    }

    public function setDtEmail(\DateTimeInterface $dtEmail): static
    {
        $this->dtEmail = $dtEmail;

        return $this;
    }

    public function getSubjectEmail(): ?string
    {
        return $this->subjectEmail;
    }

    public function setSubjectEmail(string $subjectEmail): static
    {
        $this->subjectEmail = $subjectEmail;

        return $this;
    }

    public function getContentEmail(): ?string
    {
        return $this->contentEmail;
    }

    public function setContentEmail(string $contentEmail): static
    {
        $this->contentEmail = $contentEmail;

        return $this;
    }
}
