<?php

namespace App\Entity;

use App\Repository\SpotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpotRepository::class)]
class Spot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $code;

    #[ORM\Column(type: 'string', length: 255)]
    private $size;

    #[ORM\Column(type: 'string', length: 255)]
    private $distanceElectricity;

    #[ORM\Column(type: 'boolean')]
    private $isSeasonSpot;

    const ONE = 'ONE';
    const TWO = 'TWO';
    const THREE = 'THREE';
    const FOUR = 'FOUR';
    const FIVE = 'FIVE'; 
    const SIX = 'SIX';

    const SEVEN = 'SEVEN';
    const EIGHT = 'EIGHT';
    const NINE = 'NINE';
    const TEN = 'TEN';
    const ELEVEN = 'ELEVEN';
    const TWELVE = 'TWELVE';
    const THIRTEEN = 'THIRTEEN';
    const FOURTEEN = 'FOURTEEN';
    const FIVTEEN = 'FIVTEEN';
    const SIXTEEN = 'SIXTEEN';
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

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDistanceElectricity(): ?string
    {
        return $this->distanceElectricity;
    }

    public function setDistanceElectricity(string $distanceElectricity): self
    {
        $this->distanceElectricity = $distanceElectricity;

        return $this;
    }

    public function getIsSeasonSpot(): ?bool
    {
        return $this->isSeasonSpot;
    }

    public function setIsSeasonSpot(bool $isSeasonSpot): self
    {
        $this->isSeasonSpot = $isSeasonSpot;

        return $this;
    }
}
