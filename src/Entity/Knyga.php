<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Knyga
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pavadinimas = null;

    #[ORM\Column(length: 255)]
    private ?string $autorius = null;

    #[ORM\Column]
    private ?int $isleidimo_metai = null;

    #[ORM\Column(length: 13)]
    private ?string $ISBN = null;

    #[ORM\Column(length: 255)]
    private ?string $Apie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nuotrauka = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPavadinimas(): ?string
    {
        return $this->pavadinimas;
    }

    public function setPavadinimas(string $pavadinimas): static
    {
        $this->pavadinimas = $pavadinimas;

        return $this;
    }

    public function getAutorius(): ?string
    {
        return $this->autorius;
    }

    public function setAutorius(string $autorius): static
    {
        $this->autorius = $autorius;

        return $this;
    }

    public function getIsleidimoMetai(): ?int
    {
        return $this->isleidimo_metai;
    }

    public function setIsleidimoMetai(int $isleidimo_metai): static
    {
        $this->isleidimo_metai = $isleidimo_metai;

        return $this;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): static
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getApie(): ?string
    {
        return $this->Apie;
    }

    public function setApie(string $Apie): static
    {
        $this->Apie = $Apie;

        return $this;
    }

    public function getNuotrauka(): ?string
    {
        return $this->nuotrauka;
    }

    public function setNuotrauka(?string $nuotrauka): static
    {
        $this->nuotrauka = $nuotrauka;

        return $this;
    }
}
