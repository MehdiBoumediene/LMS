<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ModulesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ModulesRepository::class)
 */
class Modules
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
     * @ORM\ManyToOne(targetEntity=Blocs::class, inversedBy="modules")
     */
    private $bloc;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $created_by;

    /**
     * @ORM\ManyToMany(targetEntity=Intervenants::class, mappedBy="modules")
     */
    private $intervenants;

    /**
     * @ORM\ManyToMany(targetEntity=Etudiants::class, mappedBy="modules")
     */
    private $etudiants;

    /**
     * @ORM\OneToMany(targetEntity=Absences::class, mappedBy="module")
     */
    private $absences;

    /**
     * @ORM\OneToMany(targetEntity=Documents::class, mappedBy="module")
     */
    private $documents;

    /**
     * @ORM\ManyToOne(targetEntity=Classes::class, inversedBy="modules")
     */
    private $classes;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="module")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Medias::class, mappedBy="module", orphanRemoval=true, cascade={"persist"})
     
     */
    private $medias;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Couvertures::class, mappedBy="module", cascade={"all"})
     */
    private $couvertures;

    /**
     * @ORM\ManyToOne(targetEntity=Formations::class, inversedBy="module")
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity=Files::class, mappedBy="module", cascade={"all"})
     */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity=Chapitres::class, mappedBy="modules")
     */
    private $chapitre;


 



   
   

    public function __construct()
    {
        $this->intervenants = new ArrayCollection();
        $this->etudiants = new ArrayCollection();
        $this->absences = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->medias = new ArrayCollection();
        $this->couvertures = new ArrayCollection();
        $this->files = new ArrayCollection();
        $this->chapitre = new ArrayCollection();
      

        
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

    public function setCreatedBy(?string $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    /**
     * @return Collection<int, Intervenants>
     */
    public function getIntervenants(): Collection
    {
        return $this->intervenants;
    }

    public function addIntervenant(Intervenants $intervenant): self
    {
        if (!$this->intervenants->contains($intervenant)) {
            $this->intervenants[] = $intervenant;
            $intervenant->addModule($this);
        }

        return $this;
    }

    public function removeIntervenant(Intervenants $intervenant): self
    {
        if ($this->intervenants->removeElement($intervenant)) {
            $intervenant->removeModule($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Etudiants>
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiants $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->addModule($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiants $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            $etudiant->removeModule($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Absences>
     */
    public function getAbsences(): Collection
    {
        return $this->absences;
    }

    public function addAbsence(Absences $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setModule($this);
        }

        return $this;
    }

    public function removeAbsence(Absences $absence): self
    {
        if ($this->absences->removeElement($absence)) {
            // set the owning side to null (unless already changed)
            if ($absence->getModule() === $this) {
                $absence->setModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Documents>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Documents $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setModule($this);
        }

        return $this;
    }

    public function removeDocument(Documents $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getModule() === $this) {
                $document->setModule(null);
            }
        }

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
            $media->setModule($this);
        }

        return $this;
    }

    public function removeMedia(Medias $media): self
    {
        if ($this->medias->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getModule() === $this) {
                $media->setModule(null);
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
            $couverture->setModule($this);
        }

        return $this;
    }

    public function removeCouverture(Couvertures $couverture): self
    {
        if ($this->couvertures->removeElement($couverture)) {
            // set the owning side to null (unless already changed)
            if ($couverture->getModule() === $this) {
                $couverture->setModule(null);
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
            $file->setModule($this);
        }

        return $this;
    }

    public function removeFile(Files $file): self
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getModule() === $this) {
                $file->setModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chapitres>
     */
    public function getChapitre(): Collection
    {
        return $this->chapitre;
    }

    public function addChapitre(Chapitres $chapitre): self
    {
        if (!$this->chapitre->contains($chapitre)) {
            $this->chapitre[] = $chapitre;
            $chapitre->setModules($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitres $chapitre): self
    {
        if ($this->chapitre->removeElement($chapitre)) {
            // set the owning side to null (unless already changed)
            if ($chapitre->getModules() === $this) {
                $chapitre->setModules(null);
            }
        }

        return $this;
    }





  

}