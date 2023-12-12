<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $est_disponible = null;

    #[ORM\ManyToOne(inversedBy: 'equipements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hospital $hospital = null;

    #[ORM\ManyToMany(targetEntity: ServiceUrgence::class, inversedBy: 'equipements')]
    private Collection $service;

    #[ORM\Column(nullable: true)]
    private ?int $quantite = null;

    #[ORM\Column(nullable: true)]
    private ?int $disponible = null;

    public function __construct()
    {
        $this->service = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isEstDisponible(): ?bool
    {
        return $this->est_disponible;
    }

    public function setEstDisponible(bool $est_disponible): static
    {
        $this->est_disponible = $est_disponible;

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
     * @return Collection<int, ServiceUrgence>
     */
    public function getService(): Collection
    {
        return $this->service;
    }
    public function setService(?ServiceUrgence $service): static
    {
        $this->service[] = $service;

        return $this;
    }

    public function addService(ServiceUrgence $service): static
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
        }

        return $this;
    }

    public function removeService(ServiceUrgence $service): static
    {
        $this->service->removeElement($service);

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDisponible(): ?int
    {
        return $this->disponible;
    }

    public function setDisponible(?int $disponible): static
    {
        $this->disponible = $disponible;

        return $this;
    }
    public function __toString(){
        return $this->name ;
    }
}
