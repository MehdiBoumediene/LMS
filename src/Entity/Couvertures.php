<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CouverturesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CouverturesRepository::class)
 */
class Couvertures
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Modules::class, inversedBy="couvertures")
     */
    private $module;

    /**
     * @ORM\ManyToOne(targetEntity=Leschapitres::class, inversedBy="couvertures")
     */
    private $leschapitres;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getModule(): ?Modules
    {
        return $this->module;
    }

    public function setModule(?Modules $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getLeschapitres(): ?Leschapitres
    {
        return $this->leschapitres;
    }

    public function setLeschapitres(?Leschapitres $leschapitres): self
    {
        $this->leschapitres = $leschapitres;

        return $this;
    }
}
