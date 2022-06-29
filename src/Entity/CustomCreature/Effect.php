<?php

namespace App\Entity\CustomCreature;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Type\TypeEffect;
use App\Repository\CustomCreature\EffectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EffectRepository::class)]
#[ApiResource]
class Effect
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $value;

    #[ORM\ManyToOne(targetEntity: TypeEffect::class, inversedBy: 'effects')]
    #[ORM\JoinColumn(nullable: false)]
    private $typeEffect;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $duration;

    #[ORM\ManyToOne(targetEntity: Melee::class, inversedBy: 'effects')]
    private $melee;

    #[ORM\ManyToOne(targetEntity: Range::class, inversedBy: 'effects')]
    private $range;

    #[ORM\ManyToOne(targetEntity: Capacity::class, inversedBy: 'effects')]
    private $capacity;

    #[ORM\ManyToOne(targetEntity: CustomCreature::class, inversedBy: 'effects')]
    private $customCreature;

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

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getTypeEffect(): ?TypeEffect
    {
        return $this->typeEffect;
    }

    public function setTypeEffect(?TypeEffect $typeEffect): self
    {
        $this->typeEffect = $typeEffect;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getMelee(): ?Melee
    {
        return $this->melee;
    }

    public function setMelee(?Melee $melee): self
    {
        $this->melee = $melee;

        return $this;
    }

    public function getRange(): ?Range
    {
        return $this->range;
    }

    public function setRange(?Range $range): self
    {
        $this->range = $range;

        return $this;
    }

    public function getCapacity(): ?Capacity
    {
        return $this->capacity;
    }

    public function setCapacity(?Capacity $capacity): self
    {
        $this->capacity = $capacity;

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
