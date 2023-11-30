<?php

namespace App\Entity;

use App\Repository\{GameNightRepository, UserRepository, GameRepository};
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameNightRepository::class)]
class GameNight
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $slots = null;

    #[ORM\Column]
    private ?int $ageRating = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAndTime = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $describtion = null;

    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'inNights')]
    private Collection $games;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'attends')]
    private Collection $visitors;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->visitors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlots(): ?int
    {
        return $this->slots;
    }

    public function setSlots(int $slots): static
    {
        $this->slots = $slots;

        return $this;
    }

    public function getAgeRating(): ?int
    {
        return $this->ageRating;
    }

    public function setAgeRating(int $ageRating): static
    {
        $this->ageRating = $ageRating;

        return $this;
    }

    public function getDateAndTime(): ?\DateTimeInterface
    {
        return $this->dateAndTime;
    }

    public function setDateAndTime(\DateTimeInterface $dateAndTime): static
    {
        $this->dateAndTime = $dateAndTime;

        return $this;
    }

    public function getDescribtion(): ?string
    {
        return $this->describtion;
    }

    public function setDescribtion(string $describtion): static
    {
        $this->describtion = $describtion;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->addInNight($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            $game->removeInNight($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getVisitors(): Collection
    {
        return $this->visitors;
    }

    public function addVisitor(User $visitor): static
    {
        if (!$this->visitors->contains($visitor)) {
            $this->visitors->add($visitor);
            $visitor->addAttend($this);
        }

        return $this;
    }

    public function removeVisitor(User $visitor): static
    {
        if ($this->visitors->removeElement($visitor)) {
            $visitor->removeAttend($this);
        }

        return $this;
    }
}
