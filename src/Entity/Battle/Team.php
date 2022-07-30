<?php

namespace App\Entity\Battle;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CustomCreature\CustomCreature;
use App\Repository\Battle\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
#[ApiResource]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $color;

    #[ORM\ManyToOne(targetEntity: Battle::class, inversedBy: 'teams')]
    #[ORM\JoinColumn(nullable: false)]
    private $battle;

    #[ORM\ManyToMany(targetEntity: CustomCreature::class, mappedBy: 'teams')]
    private $customCreatures;

    public function __construct()
    {
        $this->customCreatures = new ArrayCollection();
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getBattle(): ?Battle
    {
        return $this->battle;
    }

    public function setBattle(?Battle $battle): self
    {
        $this->battle = $battle;

        return $this;
    }

    /**
     * @return Collection<int, CustomCreature>
     */
    public function getCustomCreatures(): Collection
    {
        return $this->customCreatures;
    }

    public function addCustomCreature(CustomCreature $customCreature): self
    {
        if (!$this->customCreatures->contains($customCreature)) {
            $this->customCreatures[] = $customCreature;
            $customCreature->addTeam($this);
        }

        return $this;
    }

    public function removeCustomCreature(CustomCreature $customCreature): self
    {
        if ($this->customCreatures->removeElement($customCreature)) {
            $customCreature->removeTeam($this);
        }

        return $this;
    }
}
