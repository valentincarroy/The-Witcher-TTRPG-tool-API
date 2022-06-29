<?php

namespace App\Entity\Type;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Type\TypeMainAbilityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeMainAbilityRepository::class)]
#[ApiResource]
class TypeMainAbility
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'typeMainAbility', targetEntity: TypeAbility::class, orphanRemoval: true)]
    private $typeAbilities;

    public function __construct()
    {
        $this->typeAbilities = new ArrayCollection();
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
     * @return Collection<int, TypeAbility>
     */
    public function getTypeAbility(): Collection
    {
        return $this->typeAbilities;
    }

    public function addTypeAbility(TypeAbility $typeAbility): self
    {
        if (!$this->typeAbilities->contains($typeAbility)) {
            $this->typeAbilities[] = $typeAbility;
            $typeAbility->setTypeMainAbility($this);
        }

        return $this;
    }

    public function removeTypeAbility(TypeAbility $typeAbility): self
    {
        if ($this->typeAbilities->removeElement($typeAbility)) {
            // set the owning side to null (unless already changed)
            if ($typeAbility->getTypeMainAbility() === $this) {
                $typeAbility->setTypeMainAbility(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TypeAbility>
     */
    public function getTypeAbilities(): Collection
    {
        return $this->typeAbilities;
    }
}
