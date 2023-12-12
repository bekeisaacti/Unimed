<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'notifications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hospital $hopital = null;

    #[ORM\OneToOne(inversedBy: 'notification', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Referencement $transfert = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_At = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHopital(): ?Hospital
    {
        return $this->hopital;
    }

    public function setHopital(?Hospital $hopital): static
    {
        $this->hopital = $hopital;

        return $this;
    }

    public function getTransfert(): ?Referencement
    {
        return $this->transfert;
    }

    public function setTransfert(Referencement $transfert): static
    {
        $this->transfert = $transfert;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_At;
    }

    public function setCreatedAt(\DateTimeInterface $created_At): static
    {
        $this->created_At = $created_At;

        return $this;
    }
}
