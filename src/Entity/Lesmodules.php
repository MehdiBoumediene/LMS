<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LesmodulesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=LesmodulesRepository::class)
 */
class Lesmodules
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;



    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=Formations::class, inversedBy="lesmodules")
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity=Leschapitres::class, mappedBy="lesmodules")
     */
    private $leschapitres;

    /**
     * @ORM\ManyToOne(targetEntity=Blocs::class, inversedBy="lesmodules")
     */
    private $blocs;

    public function __construct()
    {
        $this->leschapitres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }



    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getFormations(): ?Formations
    {
        return $this->formations;
    }

    public function setFormations(?Formations $formations): self
    {
        $this->formations = $formations;

        return $this;
    }

    /**
     * @return Collection<int, Leschapitres>
     */
    public function getLeschapitres(): Collection
    {
        return $this->leschapitres;
    }

    public function addLeschapitre(Leschapitres $leschapitre): self
    {
        if (!$this->leschapitres->contains($leschapitre)) {
            $this->leschapitres[] = $leschapitre;
            $leschapitre->setLesmodules($this);
        }

        return $this;
    }

    public function removeLeschapitre(Leschapitres $leschapitre): self
    {
        if ($this->leschapitres->removeElement($leschapitre)) {
            // set the owning side to null (unless already changed)
            if ($leschapitre->getLesmodules() === $this) {
                $leschapitre->setLesmodules(null);
            }
        }

        return $this;
    }

    public function getBlocs(): ?Blocs
    {
        return $this->blocs;
    }

    public function setBlocs(?Blocs $blocs): self
    {
        $this->blocs = $blocs;

        return $this;
    }
}
