<?php

namespace App\Entity\Battle;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CustomCreature\CustomCreature;
use App\Repository\Battle\TurnRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TurnRepository::class)]
#[ApiResource]
class Turn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $number;

    #[ORM\ManyToOne(targetEntity: CustomCreature::class, inversedBy: 'turn')]
    #[ORM\JoinColumn(nullable: false)]
    private $customCreature;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

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
