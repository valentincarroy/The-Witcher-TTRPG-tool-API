<?php

namespace App\Entity\Creature;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CustomCreature\CustomCreature;
use App\Entity\Type\TypeCreature;
use App\Repository\Creature\CreatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreatureRepository::class)]
#[ApiResource]
class Creature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $health;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $endurance;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $armor;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $regeneration;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\ManyToOne(targetEntity: TypeCreature::class, inversedBy: 'creatures')]
    #[ORM\JoinColumn(nullable: false)]
    private $typeCreature;

    #[ORM\OneToMany(mappedBy: 'creature', targetEntity: MainAbility::class)]
    private $mainAbilities;

    #[ORM\OneToMany(mappedBy: 'creature', targetEntity: Ability::class)]
    private $abilities;

    #[ORM\OneToMany(mappedBy: 'creature', targetEntity: CustomCreature::class)]
    private $customCreatures;

    public function __construct()
    {
        $this->mainAbilities = new ArrayCollection();
        $this->abilities = new ArrayCollection();
        $this->customCreatures = new ArrayCollection();
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

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getEndurance(): ?int
    {
        return $this->endurance;
    }

    public function setEndurance(?int $endurance): self
    {
        $this->endurance = $endurance;

        return $this;
    }

    public function getArmor(): ?int
    {
        return $this->armor;
    }

    public function setArmor(?int $armor): self
    {
        $this->armor = $armor;

        return $this;
    }

    public function getRegeneration(): ?int
    {
        return $this->regeneration;
    }

    public function setRegeneration(?int $regeneration): self
    {
        $this->regeneration = $regeneration;

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

    public function getTypeCreature(): ?TypeCreature
    {
        return $this->typeCreature;
    }

    public function setTypeCreature(?TypeCreature $typeCreature): self
    {
        $this->typeCreature = $typeCreature;

        return $this;
    }

    /**
     * @return Collection<int, MainAbility>
     */
    public function getMainAbilities(): Collection
    {
        return $this->mainAbilities;
    }

    public function addMainAbility(MainAbility $mainAbility): self
    {
        if (!$this->mainAbilities->contains($mainAbility)) {
            $this->mainAbilities[] = $mainAbility;
            $mainAbility->setCreature($this);
        }

        return $this;
    }

    public function removeMainAbility(MainAbility $mainAbility): self
    {
        if ($this->mainAbilities->removeElement($mainAbility)) {
            // set the owning side to null (unless already changed)
            if ($mainAbility->getCreature() === $this) {
                $mainAbility->setCreature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ability>
     */
    public function getAbilities(): Collection
    {
        return $this->abilities;
    }

    public function addAbility(Ability $ability): self
    {
        if (!$this->abilities->contains($ability)) {
            $this->abilities[] = $ability;
            $ability->setCreature($this);
        }

        return $this;
    }

    public function removeAbility(Ability $ability): self
    {
        if ($this->abilities->removeElement($ability)) {
            // set the owning side to null (unless already changed)
            if ($ability->getCreature() === $this) {
                $ability->setCreature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CustomCreature>
     */
    public function getCustomCreatures(): Collection
    {
        return $this->customCreatures;
    }

    public function addCustomCreature(CustomCreature $customCreature): self
    {
        if (!$this->customCreatures->contains($customCreature)) {
            $this->customCreatures[] = $customCreature;
            $customCreature->setCreature($this);
        }

        return $this;
    }

    public function removeCustomCreature(CustomCreature $customCreature): self
    {
        if ($this->customCreatures->removeElement($customCreature)) {
            // set the owning side to null (unless already changed)
            if ($customCreature->getCreature() === $this) {
                $customCreature->setCreature(null);
            }
        }

        return $this;
    }
}
