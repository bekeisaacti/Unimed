<?php

namespace App\Entity;

use App\Repository\HospitalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HospitalRepository::class)]
class Hospital
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 25)]
    private ?string $telephone = null;

    #[ORM\Column(length: 150)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $localisation = null;

    #[ORM\OneToMany(mappedBy: 'hospital', targetEntity: ServiceUrgence::class)]
    private Collection $serviceUrgences;

    #[ORM\OneToMany(mappedBy: 'hospital', targetEntity: Equipement::class)]
    private Collection $equipements;

    #[ORM\OneToMany(mappedBy: 'hospital', targetEntity: SpecialteMedicale::class)]
    private Collection $specialteMedicales;

    #[ORM\OneToMany(mappedBy: 'hospital', targetEntity: Patient::class)]
    private Collection $patients;

    #[ORM\OneToMany(mappedBy: 'hospital', targetEntity: Medecin::class)]
    private Collection $medecins;

    #[ORM\OneToMany(mappedBy: 'hospital', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'hospital_origine', targetEntity: Referencement::class)]
    private Collection $referencements;


    #[ORM\OneToMany(mappedBy: 'hospital', targetEntity: Log::class)]
    private Collection $logs;

    public function __construct()
    {
        $this->serviceUrgences = new ArrayCollection();
        $this->equipements = new ArrayCollection();
        $this->specialteMedicales = new ArrayCollection();
        $this->patients = new ArrayCollection();
        $this->medecins = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->referencements = new ArrayCollection();
        $this->logs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * @return Collection<int, ServiceUrgence>
     */
    public function getServiceUrgences(): Collection
    {
        return $this->serviceUrgences;
    }

    public function addServiceUrgence(ServiceUrgence $serviceUrgence): static
    {
        if (!$this->serviceUrgences->contains($serviceUrgence)) {
            $this->serviceUrgences->add($serviceUrgence);
            $serviceUrgence->setHospital($this);
        }

        return $this;
    }

    public function removeServiceUrgence(ServiceUrgence $serviceUrgence): static
    {
        if ($this->serviceUrgences->removeElement($serviceUrgence)) {
            // set the owning side to null (unless already changed)
            if ($serviceUrgence->getHospital() === $this) {
                $serviceUrgence->setHospital(null);
            }
        }

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
            $equipement->setHospital($this);
        }

        return $this;
    }

    public function removeEquipement(Equipement $equipement): static
    {
        if ($this->equipements->removeElement($equipement)) {
            // set the owning side to null (unless already changed)
            if ($equipement->getHospital() === $this) {
                $equipement->setHospital(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SpecialteMedicale>
     */
    public function getSpecialteMedicales(): Collection
    {
        return $this->specialteMedicales;
    }

    public function addSpecialteMedicale(SpecialteMedicale $specialteMedicale): static
    {
        if (!$this->specialteMedicales->contains($specialteMedicale)) {
            $this->specialteMedicales->add($specialteMedicale);
            $specialteMedicale->setHospital($this);
        }

        return $this;
    }

    public function removeSpecialteMedicale(SpecialteMedicale $specialteMedicale): static
    {
        if ($this->specialteMedicales->removeElement($specialteMedicale)) {
            // set the owning side to null (unless already changed)
            if ($specialteMedicale->getHospital() === $this) {
                $specialteMedicale->setHospital(null);
            }
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
            $patient->setHospital($this);
        }

        return $this;
    }

    public function removePatient(Patient $patient): static
    {
        if ($this->patients->removeElement($patient)) {
            // set the owning side to null (unless already changed)
            if ($patient->getHospital() === $this) {
                $patient->setHospital(null);
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
            $medecin->setHospital($this);
        }

        return $this;
    }

    public function removeMedecin(Medecin $medecin): static
    {
        if ($this->medecins->removeElement($medecin)) {
            // set the owning side to null (unless already changed)
            if ($medecin->getHospital() === $this) {
                $medecin->setHospital(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setHospital($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getHospital() === $this) {
                $user->setHospital(null);
            }
        }

        return $this;
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
            $referencement->setHospitalOrigine($this);
        }

        return $this;
    }

    public function removeReferencement(Referencement $referencement): static
    {
        if ($this->referencements->removeElement($referencement)) {
            // set the owning side to null (unless already changed)
            if ($referencement->getHospitalOrigine() === $this) {
                $referencement->setHospitalOrigine(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->nom;
    }

   

    /**
     * @return Collection<int, Log>
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(Log $log): static
    {
        if (!$this->logs->contains($log)) {
            $this->logs->add($log);
            $log->setHospital($this);
        }

        return $this;
    }

    public function removeLog(Log $log): static
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getHospital() === $this) {
                $log->setHospital(null);
            }
        }

        return $this;
    }
}
