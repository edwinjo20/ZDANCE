<?php

// src/Entity/EvtPresence.php
namespace App\Entity;

use App\Repository\EvtPresenceRepository;
use Doctrine\ORM\Mapping as ORM;




            #[ORM\Entity(repositoryClass: EvtPresenceRepository::class)]
            #[ORM\Table(name: 'Evt_Presence')]
            #[ORM\UniqueConstraint(name: 'evt_presence_unique', columns: ['id_evt', 'id_adh'])]
            #[ORM\Index(name: 'FK_EVT_PRESENCE_ID_ADH', columns: ['id_adh'])]
class EvtPresence
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement", inversedBy="evtPresences")
     * @ORM\JoinColumn(name="id_evt", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
     #[ORM\Id]
     #[ORM\ManyToOne(targetEntity: Evenements::class, inversedBy: 'Evt_Presence')]
     #[ORM\JoinColumn(name: 'id_evt', referencedColumnName: 'id_evt', nullable: false, options: ["index" => false])]
     private ?Evenements $evenement = null;
    

    



     #[ORM\Id]
     #[ORM\ManyToOne(targetEntity: Adherents::class, inversedBy: 'Evt_Presence')]
     #[ORM\JoinColumn(name: 'id_adh', referencedColumnName: 'id_adh', nullable: false,options: ["index" => false])]
     private ?Adherents $adherent = null;

    // Ajoutez d'autres champs si nécessaire (par exemple, une date de présence)

    public function getEvenement(): ?Evenements
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenements $evenement): self
    {
        $this->evenement = $evenement;
        return $this;
    }

    public function getAdherent(): ?Adherents
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherents $adherent): self
    {
        $this->adherent = $adherent;
        return $this;
    }
}