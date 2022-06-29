<?php

namespace App\Entity\Creature;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Type\TypeAbility;
use App\Repository\Creature\AbilityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbilityRepository::class)]
#[ApiResource]
class Ability
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $value;

    #[ORM\ManyToOne(targetEntity: TypeAbility::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $typeAbility;

    #[ORM\ManyToOne(targetEntity: Creature::class, inversedBy: 'abilities')]
    private $creature;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeAbility(): ?TypeAbility
    {
        return $this->typeAbility;
    }

    public function setTypeAbility(?TypeAbility $typeAbility): self
    {
        $this->typeAbility = $typeAbility;

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
}
