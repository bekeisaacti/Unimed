<?php

namespace App\Entity;

use App\Repository\ServiceUrgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceUrgenceRepository::class)]
class ServiceUrgence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column]
    private ?int $lits_occupes = null;

    #[ORM\Column]
    private ?int $lits_disponibles = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 25)]
    private ?string $telephone = null;

    #[ORM\ManyToOne(inversedBy: 'serviceUrgences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hospital $hospital = null;

    #[ORM\ManyToMany(targetEntity: Equipement::class, mappedBy: 'service')]
    private Collection $equipements;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Patient::class)]
    private Collection $patients;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Medecin::class)]
    private Collection $medecins;

    #[ORM\OneToMany(mappedBy: 'service_origine', targetEntity: Referencement::class)]
    private Collection $referencements;


    public function __construct()
    {
        $this->equipements = new ArrayCollection();
        $this->patients = new ArrayCollection();
        $this->medecins = new ArrayCollection();
        $this->referencements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getLitsOccupes(): ?int
    {
        return $this->lits_occupes;
    }

    public function setLitsOccupes(int $lits_occupes): static
    {
        $this->lits_occupes = $lits_occupes;

        return $this;
    }

    public function getLitsDisponibles(): ?int
    {
        return $this->lits_disponibles;
    }

    public function setLitsDisponibles(int $lits_disponibles): static
    {
        $this->lits_disponibles = $lits_disponibles;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getHospital(): ?Hospital
    {
        return $this->hospital;
    }

    public function setHospital(?Hospital $hospital): static
    {
        $this->hospital = $hospital;

        return $this;
    }

    /**
     * @return Collection<int, Equipement>
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    public function addEquipement(Equipement $equipement): static
    {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->addService($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            $equipement->removeService($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Patient>
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    public function addPatient(Patient $patient): static
    {
        if (!$this->patients->contains($patient)) {
            $this->patients->add($patient);
            $patient->setService($this);
        }

        return $this;
    }

    public function removePatient(Patient $patient): static
    {
        if ($this->patients->removeElement($patient)) {
            // set the owning side to null (unless already changed)
            if ($patient->getService() === $this) {
                $patient->setService(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Medecin>
     */
    public function getMedecins(): Collection
    {
        return $this->medecins;
    }

    public function addMedecin(Medecin $medecin): static
    {
        if (!$this->medecins->contains($medecin)) {
            $this->medecins->add($medecin);
            $medecin->setService($this);
        }

        return $this;
    }

    public function removeMedecin(Medecin $medecin): static
    {
        if ($this->medecins->removeElement($medecin)) {
            // set the owning side to null (unless already changed)
            if ($medecin->getService() === $this) {
                $medecin->setService(null);
            }
        }

        return $this;
    }

    
    public function __toString(){
        return $this->nom;
    }

    /**
     * @return Collection<int, Referencement>
     */
    public function getReferencements(): Collection
    {
        return $this->referencements;
    }

    public function addReferencement(Referencement $referencement): static
    {
        if (!$this->referencements->contains($referencement)) {
            $this->referencements->add($referencement);
            $referencement->setServiceOrigine($this);
        }

        return $this;
    }

    public function removeReferencement(Referencement $referencement): static
    {
        if ($this->referencements->removeElement($referencement)) {
            // set the owning side to null (unless already changed)
            if ($referencement->getServiceOrigine() === $this) {
                $referencement->setServiceOrigine(null);
            }
        }

        return $this;
    }
}
