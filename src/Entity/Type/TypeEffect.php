<?php

namespace App\Entity\Type;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CustomCreature\Effect;
use App\Repository\Type\TypeEffectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeEffectRepository::class)]
#[ApiResource]
class TypeEffect
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\ManyToOne(targetEntity: TypeCreature::class, inversedBy: 'typeEffects')]
    private $typeCreature;

    #[ORM\OneToMany(mappedBy: 'typeEffect', targetEntity: Effect::class)]
    private $effects;

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
            $effect->setTypeEffect($this);
        }

        return $this;
    }

    public function removeEffect(Effect $effect): self
    {
        if ($this->effects->removeElement($effect)) {
            // set the owning side to null (unless already changed)
            if ($effect->getTypeEffect() === $this) {
                $effect->setTypeEffect(null);
            }
        }

        return $this;
    }
}
