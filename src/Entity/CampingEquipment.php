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
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $code;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'boolean')]
    private $hasElectricity;

    const CARAVAN_ELECTRIC = 'CAR_E';
    const CAMPER_ELECTRIC = 'CAM_E';
    const TENT_ELECTRIC = 'TENT_E';
    const CARAVAN_NOT_ELECTRIC = 'CAR_NO_E';
    const CAMPER_NOT_ELECTRIC = 'CAM_NO_E';
    const TENT_NOT_ELECTRIC = 'TENT_NO_E';

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

    public function getHasElectricity(): ?bool
    {
        return $this->hasElectricity;
    }

    public function setHasElectricity(bool $hasElectricity): self
    {
        $this->hasElectricity = $hasElectricity;

        return $this;
    }
}
