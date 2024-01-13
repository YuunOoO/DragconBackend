<?php

// api/src/Entity/Location.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity]
#[ApiResource]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $latitude = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $longitude = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?string $ekipa_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getEkipaName(): ?string
    {
        return $this->ekipa_name;
    }

    public function setEkipaName(?string $ekipa_name): self
    {
        $this->ekipa_name = $ekipa_name;

        return $this;
    }

}
