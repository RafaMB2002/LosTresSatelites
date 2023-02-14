<?php

namespace App\Entity;

use App\Repository\MensajeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MensajeRepository::class)]
class Mensaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaHora = null;

    #[ORM\Column]
    private ?bool $Valido = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Banda $banda_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modo $modo_id = null;

    #[ORM\ManyToOne(inversedBy: 'id_mensaje')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $id_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaHora(): ?\DateTimeInterface
    {
        return $this->fechaHora;
    }

    public function setFechaHora(\DateTimeInterface $fechaHora): self
    {
        $this->fechaHora = $fechaHora;

        return $this;
    }

    public function isValido(): ?bool
    {
        return $this->Valido;
    }

    public function setValido(bool $Valido): self
    {
        $this->Valido = $Valido;

        return $this;
    }

    public function getBandaId(): ?Banda
    {
        return $this->banda_id;
    }

    public function setBandaId(?Banda $banda_id): self
    {
        $this->banda_id = $banda_id;

        return $this;
    }

    public function getModoId(): ?Modo
    {
        return $this->modo_id;
    }

    public function setModoId(?Modo $modo_id): self
    {
        $this->modo_id = $modo_id;

        return $this;
    }

    public function getIdUser(): ?user
    {
        return $this->id_user;
    }

    public function setIdUser(?user $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }
}
