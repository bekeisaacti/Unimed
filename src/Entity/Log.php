<?php

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogRepository::class)]
class Log
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $entity_name = null;

    #[ORM\Column(length: 50)]
    private ?string $action = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $field_name = [];

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $old_value = [];

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $new_value = [];

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $motified_at = null;

    #[ORM\ManyToOne(inversedBy: 'logs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\Column]
    private ?int $entity_id = null;

    #[ORM\ManyToOne(inversedBy: 'logs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hospital $hospital = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntityName(): ?string
    {
        return $this->entity_name;
    }

    public function setEntityName(string $entity_name): static
    {
        $this->entity_name = $entity_name;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): static
    {
        $this->action = $action;

        return $this;
    }

    public function getFieldName(): array
    {
        return $this->field_name;
    }

    public function setFieldName(array $field_name): static
    {
        $this->field_name = $field_name;

        return $this;
    }

    public function getOldValue(): array
    {
        return $this->old_value;
    }

    public function setOldValue(array $old_value): static
    {
        $this->old_value = $old_value;

        return $this;
    }

    public function getNewValue(): array
    {
        return $this->new_value;
    }

    public function setNewValue(array $new_value): static
    {
        $this->new_value = $new_value;

        return $this;
    }

    public function getMotifiedAt(): ?\DateTimeInterface
    {
        return $this->motified_at;
    }

    public function setMotifiedAt(\DateTimeInterface $motified_at): static
    {
        $this->motified_at = $motified_at;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getEntityId(): ?int
    {
        return $this->entity_id;
    }

    public function setEntityId(int $entity_id): static
    {
        $this->entity_id = $entity_id;

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
}
