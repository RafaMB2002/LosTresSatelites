<?php

namespace App\Entity;

use App\Repository\BandaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandaRepository::class)]
class Banda
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $distancia = null;

    #[ORM\Column]
    private ?int $rangoMin = null;

    #[ORM\Column]
    private ?int $rangoMax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistancia(): ?int
    {
        return $this->distancia;
    }

    public function setDistancia(int $distancia): self
    {
        $this->distancia = $distancia;

        return $this;
    }

    public function getRangoMin(): ?int
    {
        return $this->rangoMin;
    }

    public function setRangoMin(int $rangoMin): self
    {
        $this->rangoMin = $rangoMin;

        return $this;
    }

    public function getRangoMax(): ?int
    {
        return $this->rangoMax;
    }

    public function setRangoMax(int $rangoMax): self
    {
        $this->rangoMax = $rangoMax;

        return $this;
    }
}
