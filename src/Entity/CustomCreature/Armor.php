<?php

namespace App\Entity\CustomCreature;

use App\Repository\CustomCreature\ArmorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArmorRepository::class)]
class Armor extends Gear
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $value;

    #[ORM\ManyToOne(targetEntity: Gear::class, inversedBy: "armors")]
    private $target;

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

    public function getTarget(): ?Gear
    {
        return $this->target;
    }

    public function setTarget(?Gear $target): self
    {
        $this->target = $target;

        return $this;
    }
}
