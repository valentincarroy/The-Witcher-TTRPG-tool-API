<?php

namespace App\Entity\Creature;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Type\TypeMainAbility;
use App\Repository\Creature\MainAbilityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MainAbilityRepository::class)]
#[ApiResource]
class MainAbility
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $value;

    #[ORM\ManyToOne(targetEntity: TypeMainAbility::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $typeMainAbility;

    #[ORM\ManyToOne(targetEntity: Creature::class, inversedBy: 'mainAbilities')]
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

    public function getTypeMainAbility(): ?TypeMainAbility
    {
        return $this->typeMainAbility;
    }

    public function setTypeMainAbility(?TypeMainAbility $typeMainAbility): self
    {
        $this->typeMainAbility = $typeMainAbility;

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
