<?php

namespace App\Entity\CustomCreature;

use App\Repository\MeleeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeleeRepository::class)]
class Melee extends Gear
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $damage;

    #[ORM\Column(type: 'integer')]
    private $reliability;

    #[ORM\ManyToOne(targetEntity: Gear::class, inversedBy: "melees")]
    private $target;

    #[ORM\OneToMany(mappedBy: 'melee', targetEntity: Effect::class)]
    private $effects;

    public function __construct()
    {
        parent::__construct();
        $this->effects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDamage(): ?int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): self
    {
        $this->damage = $damage;

        return $this;
    }

    public function getReliability(): ?int
    {
        return $this->reliability;
    }

    public function setReliability(int $reliability): self
    {
        $this->reliability = $reliability;

        return $this;
    }

    public function getTarget(): ?Gear
    {
        return $this->target;
    }

    public function setTarget(?Gear $target): self
    {
        $this->target = $target;

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
            $effect->setMelee($this);
        }

        return $this;
    }

    public function removeEffect(Effect $effect): self
    {
        if ($this->effects->removeElement($effect)) {
            // set the owning side to null (unless already changed)
            if ($effect->getMelee() === $this) {
                $effect->setMelee(null);
            }
        }

        return $this;
    }
}
