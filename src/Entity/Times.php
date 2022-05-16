<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TimesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TimesRepository::class)
 */
class Times
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="times")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Leschapitres::class, inversedBy="times")
     */
    private $chapitre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heur =0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $minutes =0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondes =0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $timer =0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getChapitre(): ?Leschapitres
    {
        return $this->chapitre;
    }

    public function setChapitre(?Leschapitres $chapitre): self
    {
        $this->chapitre = $chapitre;

        return $this;
    }

    public function getHeur(): ?string
    {
        return $this->heur;
    }

    public function setHeur(?string $heur): self
    {
        $this->heur = $heur;

        return $this;
    }

    public function getMinutes(): ?string
    {
        return $this->minutes;
    }

    public function setMinutes(?string $minutes): self
    {
        $this->minutes = $minutes;

        return $this;
    }

    public function getSecondes(): ?string
    {
        return $this->secondes;
    }

    public function setSecondes(?string $secondes): self
    {
        $this->secondes = $secondes;

        return $this;
    }

    public function getTimer(): ?string
    {
        return $this->timer;
    }

    public function setTimer(?string $timer): self
    {
        $this->timer = $timer;

        return $this;
    }
}
