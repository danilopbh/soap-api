<?php
// src/Entity/CountryInfo.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class CountryInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 3)]
    private string $countryCode;

    #[ORM\Column(type: 'string', length: 255)]
    private string $countryName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $capitalCity;

    // Getters e Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): self
    {
        $this->countryName = $countryName;
        return $this;
    }

    public function getCapitalCity(): string
    {
        return $this->capitalCity;
    }

    public function setCapitalCity(string $capitalCity): self
    {
        $this->capitalCity = $capitalCity;
        return $this;
    }
}
