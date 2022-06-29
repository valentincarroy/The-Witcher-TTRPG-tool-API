<?php

namespace App\Entity\CustomCreature;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CustomCreature\CapacityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CapacityRepository::class)]
#[ApiResource]
class Capacity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'capacity', targetEntity: Effect::class)]
    private $effects;

    #[ORM\ManyToOne(targetEntity: CustomCreature::class, inversedBy: 'capacities')]
    #[ORM\JoinColumn(nullable: false)]
    private $customCreature;

    public function __construct()
    {
        $this->effects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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
     * @return Collection<int, Effect>
     */
    public function getEffects(): Collection
    {
        return $this->effects;
    }

    public function addEffect(Effect $effect): self
    {
        if (!$this->effects->contains($effect)) {
            $this->effects[] = $effect;
            $effect->setCapacity($this);
        }

        return $this;
    }

    public function removeEffect(Effect $effect): self
    {
        if ($this->effects->removeElement($effect)) {
            // set the owning side to null (unless already changed)
            if ($effect->getCapacity() === $this) {
                $effect->setCapacity(null);
            }
        }

        return $this;
    }

    public function getCustomCreature(): ?CustomCreature
    {
        return $this->customCreature;
    }

    public function setCustomCreature(?CustomCreature $customCreature): self
    {
        $this->customCreature = $customCreature;

        return $this;
    }
}
