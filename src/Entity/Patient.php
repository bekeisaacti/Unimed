<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(length: 150)]
    private ?string $prenom = null;

    #[ORM\Column(length: 5)]
    private ?string $sexe = null;

    #[ORM\Column(length: 150)]
    private ?string $adresse = null;

    #[ORM\Column(length: 25)]
    private ?string $telephone = null;

    #[ORM\Column(length: 150)]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $allergies = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $antecedents_medicaux = null;

    #[ORM\Column(length: 25)]
    private ?string $contact_urgence = null;

    #[ORM\ManyToOne(inversedBy: 'patients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ServiceUrgence $service = null;

    #[ORM\ManyToOne(inversedBy: 'patients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hospital $hospital = null;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Referencement::class)]
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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): static
    {
        $this->sexe = $sexe;

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

    public function getAllergies(): ?string
    {
        return $this->allergies;
    }

    public function setAllergies(string $allergies): static
    {
        $this->allergies = $allergies;

        return $this;
    }

    public function getAntecedentsMedicaux(): ?string
    {
        return $this->antecedents_medicaux;
    }

    public function setAntecedentsMedicaux(string $antecedents_medicaux): static
    {
        $this->antecedents_medicaux = $antecedents_medicaux;

        return $this;
    }

    public function getContactUrgence(): ?string
    {
        return $this->contact_urgence;
    }

    public function setContactUrgence(string $contact_urgence): static
    {
        $this->contact_urgence = $contact_urgence;

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
            $referencement->setPatient($this);
        }

        return $this;
    }


    public function __toString(){
        return $this->nom . ' ' . $this->prenom ;
    }
}
