<?php

namespace App\Entity\CustomCreature;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Account;
use App\Entity\Battle\Turn;
use App\Entity\Creature\Creature;
use App\Repository\CustomCreature\CustomCreatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomCreatureRepository::class)]
#[ApiResource]
class CustomCreature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $currentHealth;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $currentArmor;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $currentEndurance;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $customImage;

    #[ORM\ManyToOne(targetEntity: Creature::class, inversedBy: 'customCreatures')]
    #[ORM\JoinColumn(nullable: false)]
    private $creature;

    #[ORM\OneToMany(mappedBy: 'customCreature', targetEntity: Effect::class)]
    private $effects;

    #[ORM\OneToMany(mappedBy: 'customCreature', targetEntity: Turn::class, orphanRemoval: true)]
    private $turn;

    #[ORM\OneToMany(mappedBy: 'customCreature', targetEntity: Gear::class, orphanRemoval: true)]
    private $gears;

    #[ORM\OneToMany(mappedBy: 'customCreature', targetEntity: Capacity::class, orphanRemoval: true)]
    private $capacities;

    #[ORM\ManyToOne(targetEntity: Account::class, inversedBy: 'customCreatures')]
    #[ORM\JoinColumn(nullable: false)]
    private $account;

    public function __construct()
    {
        $this->effects = new ArrayCollection();
        $this->turn = new ArrayCollection();
        $this->gears = new ArrayCollection();
        $this->capacities = new ArrayCollection();
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

    public function getCurrentHealth(): ?int
    {
        return $this->currentHealth;
    }

    public function setCurrentHealth(?int $currentHealth): self
    {
        $this->currentHealth = $currentHealth;

        return $this;
    }

    public function getCurrentArmor(): ?int
    {
        return $this->currentArmor;
    }

    public function setCurrentArmor(?int $currentArmor): self
    {
        $this->currentArmor = $currentArmor;

        return $this;
    }

    public function getCurrentEndurance(): ?int
    {
        return $this->currentEndurance;
    }

    public function setCurrentEndurance(?int $currentEndurance): self
    {
        $this->currentEndurance = $currentEndurance;

        return $this;
    }

    public function getCustomImage(): ?string
    {
        return $this->customImage;
    }

    public function setCustomImage(?string $customImage): self
    {
        $this->customImage = $customImage;

        return $this;
    }

    public function getCreature(): ?Creature
    {
        return $this->creature;
    }

    public function setCreature(?Creature $creature): self
    {
        $this->creature = $creature;

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
            $effect->setCustomCreature($this);
        }

        return $this;
    }

    public function removeEffect(Effect $effect): self
    {
        if ($this->effects->removeElement($effect)) {
            // set the owning side to null (unless already changed)
            if ($effect->getCustomCreature() === $this) {
                $effect->setCustomCreature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Turn>
     */
    public function getTurn(): Collection
    {
        return $this->turn;
    }

    public function addTurn(Turn $turn): self
    {
        if (!$this->turn->contains($turn)) {
            $this->turn[] = $turn;
            $turn->setCustomCreature($this);
        }

        return $this;
    }

    public function removeTurn(Turn $turn): self
    {
        if ($this->turn->removeElement($turn)) {
            // set the owning side to null (unless already changed)
            if ($turn->getCustomCreature() === $this) {
                $turn->setCustomCreature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Gear>
     */
    public function getGears(): Collection
    {
        return $this->gears;
    }

    public function addGear(Gear $gear): self
    {
        if (!$this->gears->contains($gear)) {
            $this->gears[] = $gear;
            $gear->setCustomCreature($this);
        }

        return $this;
    }

    public function removeGear(Gear $gear): self
    {
        if ($this->gears->removeElement($gear)) {
            // set the owning side to null (unless already changed)
            if ($gear->getCustomCreature() === $this) {
                $gear->setCustomCreature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Capacity>
     */
    public function getCapacities(): Collection
    {
        return $this->capacities;
    }

    public function addCapacity(Capacity $capacity): self
    {
        if (!$this->capacities->contains($capacity)) {
            $this->capacities[] = $capacity;
            $capacity->setCustomCreature($this);
        }

        return $this;
    }

    public function removeCapacity(Capacity $capacity): self
    {
        if ($this->capacities->removeElement($capacity)) {
            // set the owning side to null (unless already changed)
            if ($capacity->getCustomCreature() === $this) {
                $capacity->setCustomCreature(null);
            }
        }

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }
}
