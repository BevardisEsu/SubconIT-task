<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
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
    #[Assert\NotBlank(message: 'Knygos pavadinimas negali būti tuščias')]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Pavadinimas turi būti bent {{ limit }} simbolių ilgio',
        maxMessage: 'Pavadinimas negali būti ilgesnis nei {{ limit }} simbolių'
    )]
    private ?string $pavadinimas = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Autoriaus vardas negali būti tuščias')]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Autoriaus vardas turi būti bent {{ limit }} simbolių ilgio',
        maxMessage: 'Autoriaus vardas negali būti ilgesnis nei {{ limit }} simbolių'
    )]
    private ?string $autorius = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Išleidimo metai negali būti tušti')]
    #[Assert\Range(
        min: 1000,
        max: 2024,
        notInRangeMessage: 'Išleidimo metai turi būti tarp {{ min }} ir {{ max }}'
    )]
    private ?int $isleidimo_metai = null;

    #[ORM\Column(length: 13)]
    #[Assert\NotBlank(message: 'ISBN negali būti tuščias')]
    #[Assert\Length(
        exactly: 13,
        exactMessage: 'ISBN turi būti lygiai {{ limit }} simbolių'
    )]
    #[Assert\Regex(
        pattern: '/^[0-9]{13}$/',
        message: 'ISBN turi būti sudarytas tik iš 13 skaitmenų'
    )]
    private ?string $ISBN = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'Aprašymas negali būti tuščias')]
    #[Assert\Length(
        min: 10,
        minMessage: 'Aprašymas turi būti bent {{ limit }} simbolių ilgio'
    )]
    private ?string $apie = null;

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
        return $this->apie;
    }

    public function setApie(string $Apie): static
    {
        $this->apie = $Apie;

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
