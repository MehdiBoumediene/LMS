<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FormationsRepository::class)
 */
class Formations
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Modules::class, mappedBy="formations")
     */
    private $module;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $createdBy;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class, mappedBy="formations")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Leschapitres::class, mappedBy="formations")
     */
    private $leschapitres;

    /**
     * @ORM\OneToMany(targetEntity=Lesmodules::class, mappedBy="formations")
     */
    private $lesmodules;

    public function __construct()
    {
        $this->module = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->leschapitres = new ArrayCollection();
        $this->lesmodules = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Modules>
     */
    public function getModule(): Collection
    {
        return $this->module;
    }

    public function addModule(Modules $module): self
    {
        if (!$this->module->contains($module)) {
            $this->module[] = $module;
            $module->setFormations($this);
        }

        return $this;
    }

    public function removeModule(Modules $module): self
    {
        if ($this->module->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getFormations() === $this) {
                $module->setFormations(null);
            }
        }

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

    public function setCreatedBy(string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addFormation($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFormation($this);
        }

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
            $leschapitre->setFormations($this);
        }

        return $this;
    }

    public function removeLeschapitre(Leschapitres $leschapitre): self
    {
        if ($this->leschapitres->removeElement($leschapitre)) {
            // set the owning side to null (unless already changed)
            if ($leschapitre->getFormations() === $this) {
                $leschapitre->setFormations(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lesmodules>
     */
    public function getLesmodules(): Collection
    {
        return $this->lesmodules;
    }

    public function addLesmodule(Lesmodules $lesmodule): self
    {
        if (!$this->lesmodules->contains($lesmodule)) {
            $this->lesmodules[] = $lesmodule;
            $lesmodule->setFormations($this);
        }

        return $this;
    }

    public function removeLesmodule(Lesmodules $lesmodule): self
    {
        if ($this->lesmodules->removeElement($lesmodule)) {
            // set the owning side to null (unless already changed)
            if ($lesmodule->getFormations() === $this) {
                $lesmodule->setFormations(null);
            }
        }

        return $this;
    }
}
