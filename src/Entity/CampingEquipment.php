<?php

namespace App\Entity;

use App\Repository\CampingEquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampingEquipmentRepository::class)]
class CampingEquipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $code;

    #[ORM\Column(type: 'string', length: 255)]
    private string $description;

    #[ORM\Column(type: 'boolean')]
    private bool $hasElectricity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isHasElectricity(): ?bool
    {
        return $this->hasElectricity;
    }

    public function setHasElectricity(bool $hasElectricity): self
    {
        $this->hasElectricity = $hasElectricity;

        return $this;
    }
}
