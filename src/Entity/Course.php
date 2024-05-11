<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $schedule = null;

    #[ORM\ManyToOne(inversedBy: 'course')]
    private ?Teacher $teacher = null;

    #[ORM\OneToOne(mappedBy: 'course', cascade: ['persist', 'remove'])]
    private ?Student $student = null;

    /**
     * @var Collection<int, Material>
     */
    #[ORM\OneToMany(targetEntity: Material::class, mappedBy: 'course', orphanRemoval: true)]
    private Collection $material;

    public function __construct()
    {
        $this->material = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): static
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(Student $student): static
    {
        // set the owning side of the relation if necessary
        if ($student->getCourse() !== $this) {
            $student->setCourse($this);
        }

        $this->student = $student;

        return $this;
    }

    /**
     * @return Collection<int, Material>
     */
    public function getMaterial(): Collection
    {
        return $this->material;
    }

    public function addMaterial(Material $material): static
    {
        if (!$this->material->contains($material)) {
            $this->material->add($material);
            $material->setCourse($this);
        }

        return $this;
    }

    public function removeMaterial(Material $material): static
    {
        if ($this->material->removeElement($material)) {
            // set the owning side to null (unless already changed)
            if ($material->getCourse() === $this) {
                $material->setCourse(null);
            }
        }

        return $this;
    }
}
