<?php

namespace App\Entity\Type;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Creature\Creature;
use App\Repository\Type\TypeCreatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeCreatureRepository::class)]
#[ApiResource]
class TypeCreature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'typeCreature', targetEntity: TypeEffect::class)]
    private $typeEffects;

    #[ORM\OneToMany(mappedBy: 'typeCreature', targetEntity: Creature::class)]
    private $creatures;

    public function __construct()
    {
        $this->typeEffects = new ArrayCollection();
        $this->creatures = new ArrayCollection();
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
     * @return Collection<int, TypeEffect>
     */
    public function getTypeEffects(): Collection
    {
        return $this->typeEffects;
    }

    public function addTypeEffect(TypeEffect $typeEffect): self
    {
        if (!$this->typeEffects->contains($typeEffect)) {
            $this->typeEffects[] = $typeEffect;
            $typeEffect->setTypeCreature($this);
        }

        return $this;
    }

    public function removeTypeEffect(TypeEffect $typeEffect): self
    {
        if ($this->typeEffects->removeElement($typeEffect)) {
            // set the owning side to null (unless already changed)
            if ($typeEffect->getTypeCreature() === $this) {
                $typeEffect->setTypeCreature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Creature>
     */
    public function getCreatures(): Collection
    {
        return $this->creatures;
    }

    public function addCreature(Creature $creature): self
    {
        if (!$this->creatures->contains($creature)) {
            $this->creatures[] = $creature;
            $creature->setTypeCreature($this);
        }

        return $this;
    }

    public function removeCreature(Creature $creature): self
    {
        if ($this->creatures->removeElement($creature)) {
            // set the owning side to null (unless already changed)
            if ($creature->getTypeCreature() === $this) {
                $creature->setTypeCreature(null);
            }
        }

        return $this;
    }
}
