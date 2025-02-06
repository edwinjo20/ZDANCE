<?php 

namespace App\Entity;

use App\Repository\AdhCoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdhCoursRepository::class)]
#[ORM\Table(name: "adh_cours", 
uniqueConstraints: [new ORM\UniqueConstraint(name: "evt_presence_unique", columns: ["id_evt", "id_adh"])],
indexes: [new ORM\Index(name: "FK_EVT_PRESENCE_ID_ADH", columns: ["id_adh"])]
)]
class AdhCours
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Adherents::class, inversedBy: 'adhCours')]
    #[ORM\JoinColumn(name: 'id_adh', referencedColumnName: 'id_adh', nullable: false, onDelete: 'CASCADE')]
    private ?Adherents $adherent = null;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Cours::class, inversedBy: 'adhCours')]
    #[ORM\JoinColumn(name: 'id_cours', referencedColumnName: 'id_cours', nullable: false, onDelete: 'CASCADE')]
    private ?Cours $cours = null;

    public function getAdherent(): ?Adherents
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherents $adherent): static
    {
        $this->adherent = $adherent;
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

}
