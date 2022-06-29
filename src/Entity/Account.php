<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Battle\Battle;
use App\Entity\CustomCreature\CustomCreature;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
#[ApiResource]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'boolean')]
    private $admin;

    #[ORM\Column(type: 'string', length: 50)]
    private $login;

    #[ORM\Column(type: 'string', length: 255)]
    private $hash;

    #[ORM\OneToMany(mappedBy: 'account', targetEntity: Battle::class, orphanRemoval: true)]
    private $battles;

    #[ORM\OneToMany(mappedBy: 'account', targetEntity: CustomCreature::class, orphanRemoval: true)]
    private $customCreatures;

    public function __construct()
    {
        $this->battles = new ArrayCollection();
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

    public function isAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @return Collection<int, Battle>
     */
    public function getBattles(): Collection
    {
        return $this->battles;
    }

    public function addBattle(Battle $battle): self
    {
        if (!$this->battles->contains($battle)) {
            $this->battles[] = $battle;
            $battle->setAccount($this);
        }

        return $this;
    }

    public function removeBattle(Battle $battle): self
    {
        if ($this->battles->removeElement($battle)) {
            // set the owning side to null (unless already changed)
            if ($battle->getAccount() === $this) {
                $battle->setAccount(null);
            }
        }

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
            $customCreature->setAccount($this);
        }

        return $this;
    }

    public function removeCustomCreature(CustomCreature $customCreature): self
    {
        if ($this->customCreatures->removeElement($customCreature)) {
            // set the owning side to null (unless already changed)
            if ($customCreature->getAccount() === $this) {
                $customCreature->setAccount(null);
            }
        }

        return $this;
    }
}
