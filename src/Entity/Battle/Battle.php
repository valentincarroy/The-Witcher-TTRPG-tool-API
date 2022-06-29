<?php

namespace App\Entity\Battle;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Account;
use App\Repository\Battle\BattleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BattleRepository::class)]
#[ApiResource]
class Battle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $battleStage;

    #[ORM\OneToOne(targetEntity: Turn::class, cascade: ['persist', 'remove'])]
    private $lastTurn;

    #[ORM\OneToMany(mappedBy: 'battle', targetEntity: Team::class, orphanRemoval: true)]
    private $teams;

    #[ORM\OneToMany(mappedBy: 'battle', targetEntity: Log::class, orphanRemoval: true)]
    private $logs;

    #[ORM\ManyToOne(targetEntity: Account::class, inversedBy: 'battles')]
    #[ORM\JoinColumn(nullable: false)]
    private $account;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->logs = new ArrayCollection();
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

    public function getBattleStage(): ?int
    {
        return $this->battleStage;
    }

    public function setBattleStage(int $battleStage): self
    {
        $this->battleStage = $battleStage;

        return $this;
    }

    public function getLastTurn(): ?Turn
    {
        return $this->lastTurn;
    }

    public function setLastTurn(?Turn $lastTurn): self
    {
        $this->lastTurn = $lastTurn;

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setBattle($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getBattle() === $this) {
                $team->setBattle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Log>
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(Log $log): self
    {
        if (!$this->logs->contains($log)) {
            $this->logs[] = $log;
            $log->setBattle($this);
        }

        return $this;
    }

    public function removeLog(Log $log): self
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getBattle() === $this) {
                $log->setBattle(null);
            }
        }

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }
}
