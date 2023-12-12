<?php

namespace App\Entity;

use App\Repository\ReferencementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferencementRepository::class)]
class Referencement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_ref = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $raisons = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $remarques = null;

    #[ORM\Column(type:Types::TEXT)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'referencements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $patient = null;

    #[ORM\ManyToOne(inversedBy: 'referencements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hospital $hospital_origine = null;

    #[ORM\ManyToOne(inversedBy: 'referencements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hospital $hospital_destination = null;

    #[ORM\ManyToOne(inversedBy: 'referencements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medecin $medecin_referent = null;

    #[ORM\ManyToOne(inversedBy: 'referencements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ServiceUrgence $service_origine = null;

    #[ORM\ManyToOne(inversedBy: 'referencements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ServiceUrgence $service_destination = null;

    #[ORM\Column(nullable: true)]
    private ?bool $valider = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRef(): ?\DateTimeImmutable
    {
        return $this->date_ref;
    }

    public function setDateRef(\DateTimeImmutable $date_ref): static
    {
        $this->date_ref = $date_ref;

        return $this;
    }

    public function getRaisons(): ?string
    {
        return $this->raisons;
    }

    public function setRaisons(string $raisons): static
    {
        $this->raisons = $raisons;

        return $this;
    }

    public function getRemarques(): ?string
    {
        return $this->remarques;
    }

    public function setRemarques(string $remarques): static
    {
        $this->remarques = $remarques;

        return $this;
    }

    public function getStatus(): ?string
    {
        $status = $this->status;
        $status = 'Pending';
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    public function getHospitalOrigine(): ?Hospital
    {
        return $this->hospital_origine;
    }

    public function setHospitalOrigine(?Hospital $hospital_origine): static
    {
        $this->hospital_origine = $hospital_origine;

        return $this;
    }

    public function getHospitalDestination(): ?Hospital
    {
        return $this->hospital_destination;
    }

    public function setHospitalDestination(?Hospital $hospital_destination): static
    {
        $this->hospital_destination = $hospital_destination;

        return $this;
    }

    public function getMedecinReferent(): ?Medecin
    {
        return $this->medecin_referent;
    }

    public function setMedecinReferent(?Medecin $medecin_referent): static
    {
        $this->medecin_referent = $medecin_referent;

        return $this;
    }

    public function getServiceOrigine(): ?ServiceUrgence
    {
        return $this->service_origine;
    }

    public function setServiceOrigine(?ServiceUrgence $service_origine): static
    {
        $this->service_origine = $service_origine;

        return $this;
    }

    public function getServiceDestination(): ?ServiceUrgence
    {
        return $this->service_destination;
    }

    public function setServiceDestination(?ServiceUrgence $service_destination): static
    {
        $this->service_destination = $service_destination;

        return $this;
    }

    public function isValider(): ?bool
    {
        return $this->valider;
    }

    public function setValider(?bool $valider): static
    {
        $this->valider = $valider;

        return $this;
    }

    
}
