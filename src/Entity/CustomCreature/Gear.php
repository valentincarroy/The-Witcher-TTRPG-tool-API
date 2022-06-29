<?php

namespace App\Entity\CustomCreature;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GearRepository::class)]
#[ApiResource]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "armor" => "Armor",
    "melee" => "Melee",
    "range" => "Range"
])]
abstract class Gear
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\OneToMany(mappedBy: "target", targetEntity: Armor::class)]
    private $armors;

    #[ORM\OneToMany(mappedBy: "target", targetEntity: Range::class)]
    private $ranges;

    #[ORM\OneToMany(mappedBy: "target", targetEntity: Melee::class)]
    private $melees;

    #[ORM\ManyToOne(targetEntity: CustomCreature::class, inversedBy: 'gears')]
    #[ORM\JoinColumn(nullable: false)]
    private $customCreature;

    public function __construct()
    {
        $this->armors = new ArrayCollection();
        $this->ranges = new ArrayCollection();
        $this->melees = new ArrayCollection();
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

    /**
     * @return Collection<int, Armor>
     */
    public function getArmors(): Collection
    {
        return $this->armors;
    }

    public function addArmor(Armor $armor): self
    {
        if (!$this->armors->contains($armor)) {
            $this->armors[] = $armor;
            $armor->setTarget($this);
        }

        return $this;
    }

    public function removeArmor(Armor $armor): self
    {
        if ($this->armors->removeElement($armor)) {
            // set the owning side to null (unless already changed)
            if ($armor->getTarget() === $this) {
                $armor->setTarget(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Range>
     */
    public function getRanges(): Collection
    {
        return $this->ranges;
    }

    public function addRange(Range $range): self
    {
        if (!$this->ranges->contains($range)) {
            $this->ranges[] = $range;
            $range->setTarget($this);
        }

        return $this;
    }

    public function removeRange(Range $range): self
    {
        if ($this->ranges->removeElement($range)) {
            // set the owning side to null (unless already changed)
            if ($range->getTarget() === $this) {
                $range->setTarget(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Melee>
     */
    public function getMelees(): Collection
    {
        return $this->melees;
    }

    public function addMelee(Melee $melee): self
    {
        if (!$this->melees->contains($melee)) {
            $this->melees[] = $melee;
            $melee->setTarget($this);
        }

        return $this;
    }

    public function removeMelee(Melee $melee): self
    {
        if ($this->melees->removeElement($melee)) {
            // set the owning side to null (unless already changed)
            if ($melee->getTarget() === $this) {
                $melee->setTarget(null);
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
