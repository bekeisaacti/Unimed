<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(length: 150)]
    private ?string $prenom = null;

    #[ORM\Column(length: 25)]
    private ?string $telephone = null;

    #[ORM\Column(length: 150)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'medecins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SpecialteMedicale $specialite = null;

    #[ORM\ManyToOne(inversedBy: 'medecins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ServiceUrgence $service = null;

    #[ORM\ManyToOne(inversedBy: 'medecins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hospital $hospital = null;

    #[ORM\OneToMany(mappedBy: 'medecin_referent', targetEntity: Referencement::class)]
    private Collection $referencements;

    public function __construct()
    {
        $this->referencements = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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

    public function getSpecialite(): ?SpecialteMedicale
    {
        return $this->specialite;
    }

    public function setSpecialite(?SpecialteMedicale $specialite): static
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getService(): ?ServiceUrgence
    {
        return $this->service;
    }

    public function setService(?ServiceUrgence $service): static
    {
        $this->service = $service;

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
            $referencement->setMedecinReferent($this);
        }

        return $this;
    }

    public function removeReferencement(Referencement $referencement): static
    {
        if ($this->referencements->removeElement($referencement)) {
            // set the owning side to null (unless already changed)
            if ($referencement->getMedecinReferent() === $this) {
                $referencement->setMedecinReferent(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->nom . ' ' . $this->prenom ;
    }
}
