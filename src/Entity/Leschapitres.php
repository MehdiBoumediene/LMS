<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LeschapitresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=LeschapitresRepository::class)
 */
class Leschapitres
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
     * @ORM\ManyToOne(targetEntity=Blocs::class, inversedBy="leschapitres")
     */
    private $bloc;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=Classes::class, inversedBy="leschapitres")
     */
    private $classes;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="leschapitres")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Medias::class, mappedBy="leschapitres", cascade={"all"})
     */
    private $medias;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Couvertures::class, mappedBy="leschapitres", cascade={"all"})
     */
    private $couvertures;

    /**
     * @ORM\ManyToOne(targetEntity=Formations::class, inversedBy="leschapitres")
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity=Files::class, mappedBy="leschapitres", cascade={"all"})
     */
    private $files;

    /**
     * @ORM\ManyToOne(targetEntity=Lesmodules::class, inversedBy="leschapitres")
     */
    private $lesmodules;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $temps;



    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->couvertures = new ArrayCollection();
        $this->files = new ArrayCollection();
     
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

    public function getBloc(): ?Blocs
    {
        return $this->bloc;
    }

    public function setBloc(?Blocs $bloc): self
    {
        $this->bloc = $bloc;

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

    public function getClasses(): ?Classes
    {
        return $this->classes;
    }

    public function setClasses(?Classes $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, Medias>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Medias $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->medias[] = $media;
            $media->setLeschapitres($this);
        }

        return $this;
    }

    public function removeMedia(Medias $media): self
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getLeschapitres() === $this) {
                $media->setLeschapitres(null);
            }
        }

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
     * @return Collection<int, Couvertures>
     */
    public function getCouvertures(): Collection
    {
        return $this->couvertures;
    }

    public function addCouverture(Couvertures $couverture): self
    {
        if (!$this->couvertures->contains($couverture)) {
            $this->couvertures[] = $couverture;
            $couverture->setLeschapitres($this);
        }

        return $this;
    }

    public function removeCouverture(Couvertures $couverture): self
    {
        if ($this->couvertures->removeElement($couverture)) {
            // set the owning side to null (unless already changed)
            if ($couverture->getLeschapitres() === $this) {
                $couverture->setLeschapitres(null);
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
     * @return Collection<int, Files>
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(Files $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setLeschapitres($this);
        }

        return $this;
    }

    public function removeFile(Files $file): self
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getLeschapitres() === $this) {
                $file->setLeschapitres(null);
            }
        }

        return $this;
    }

    public function getLesmodules(): ?Lesmodules
    {
        return $this->lesmodules;
    }

    public function setLesmodules(?Lesmodules $lesmodules): self
    {
        $this->lesmodules = $lesmodules;

        return $this;
    }

    public function getTemps(): ?string
    {
        return $this->temps;
    }

    public function setTemps(?string $temps): self
    {
        $this->temps = $temps;

        return $this;
    }


}
