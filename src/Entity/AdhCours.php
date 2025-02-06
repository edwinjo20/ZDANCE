<?php

namespace App\Entity;

use App\Repository\AdhCoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdhCoursRepository::class)]
class AdhCours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Cours>
     */
    #[ORM\ManyToMany(targetEntity: Cours::class, inversedBy: 'adhCours')]
    private Collection $adherent;

    public function __construct()
    {
        $this->adherent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getAdherent(): Collection
    {
        return $this->adherent;
    }

    public function addAdherent(Cours $adherent): static
    {
        if (!$this->adherent->contains($adherent)) {
            $this->adherent->add($adherent);
        }

        return $this;
    }

    public function removeAdherent(Cours $adherent): static
    {
        $this->adherent->removeElement($adherent);

        return $this;
    }
}
