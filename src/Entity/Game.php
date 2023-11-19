<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: GameNight::class, inversedBy: 'games')]
    private Collection $inNights;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'preferredGames')]
    private Collection $likedBy;

    public function __construct()
    {
        $this->inNights = new ArrayCollection();
        $this->likedBy = new ArrayCollection();
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

    /**
     * @return Collection<int, gameNight>
     */
    public function getInNights(): Collection
    {
        return $this->inNights;
    }

    public function addInNight(GameNight $inNight): static
    {
        if (!$this->inNights->contains($inNight)) {
            $this->inNights->add($inNight);
        }

        return $this;
    }

    public function removeInNight(GameNight $inNight): static
    {
        $this->inNights->removeElement($inNight);

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getLikedBy(): Collection
    {
        return $this->likedBy;
    }

    public function addLikedBy(User $likedBy): static
    {
        if (!$this->likedBy->contains($likedBy)) {
            $this->likedBy->add($likedBy);
        }

        return $this;
    }

    public function removeLikedBy(User $likedBy): static
    {
        $this->likedBy->removeElement($likedBy);

        return $this;
    }
}
