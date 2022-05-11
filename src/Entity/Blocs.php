<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BlocsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=BlocsRepository::class)
 */
class Blocs
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
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $created_by;

    /**
     * @ORM\ManyToOne(targetEntity=Classes::class, inversedBy="blocs")
     */
    private $Classe;

    /**
     * @ORM\OneToMany(targetEntity=Modules::class, mappedBy="bloc")
     */
    private $modules;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="blocs")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Leschapitres::class, mappedBy="bloc")
     */
    private $leschapitres;

    /**
     * @ORM\ManyToOne(targetEntity=Formations::class, inversedBy="blocs")
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity=Lesmodules::class, mappedBy="blocs")
     */
    private $lesmodules;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->created_by;
    }

    public function setCreatedBy(string $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getClasse(): ?Classes
    {
        return $this->Classe;
    }

    public function setClasse(?Classes $Classe): self
    {
        $this->Classe = $Classe;

        return $this;
    }

    /**
     * @return Collection<int, Modules>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Modules $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->setBloc($this);
        }

        return $this;
    }

    public function removeModule(Modules $module): self
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getBloc() === $this) {
                $module->setBloc(null);
            }
        }

        return $this;
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
            $leschapitre->setBloc($this);
        }

        return $this;
    }

    public function removeLeschapitre(Leschapitres $leschapitre): self
    {
        if ($this->leschapitres->removeElement($leschapitre)) {
            // set the owning side to null (unless already changed)
            if ($leschapitre->getBloc() === $this) {
                $leschapitre->setBloc(null);
            }
        }

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
            $lesmodule->setBlocs($this);
        }

        return $this;
    }

    public function removeLesmodule(Lesmodules $lesmodule): self
    {
        if ($this->lesmodules->removeElement($lesmodule)) {
            // set the owning side to null (unless already changed)
            if ($lesmodule->getBlocs() === $this) {
                $lesmodule->setBlocs(null);
            }
        }

        return $this;
    }
}