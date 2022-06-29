<?php

namespace App\Entity\Type;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Type\TypeAbilityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeAbilityRepository::class)]
#[ApiResource]
class TypeAbility
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\ManyToOne(targetEntity: TypeMainAbility::class, inversedBy: 'typeAbility')]
    #[ORM\JoinColumn(nullable: false)]
    private $typeMainAbility;

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

    public function getTypeMainAbility(): ?TypeMainAbility
    {
        return $this->typeMainAbility;
    }

    public function setTypeMainAbility(?TypeMainAbility $typeMainAbility): self
    {
        $this->typeMainAbility= $typeMainAbility;

        return $this;
    }
}
