<?php

namespace App\Entity;

use App\Repository\WeeklyMenuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeeklyMenuRepository::class)]
class WeeklyMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $breakfast = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstSnack = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lunch = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondSnack = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dinner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBreakfast(): ?string
    {
        return $this->breakfast;
    }

    public function setBreakfast(?string $breakfast): self
    {
        $this->breakfast = $breakfast;

        return $this;
    }

    public function getFirstSnack(): ?string
    {
        return $this->firstSnack;
    }

    public function setFirstSnack(?string $firstSnack): self
    {
        $this->firstSnack = $firstSnack;

        return $this;
    }

    public function getLunch(): ?string
    {
        return $this->lunch;
    }

    public function setLunch(?string $lunch): self
    {
        $this->lunch = $lunch;

        return $this;
    }

    public function getSecondSnack(): ?string
    {
        return $this->secondSnack;
    }

    public function setSecondSnack(?string $secondSnack): self
    {
        $this->secondSnack = $secondSnack;

        return $this;
    }

    public function getDinner(): ?string
    {
        return $this->dinner;
    }

    public function setDinner(?string $dinner): self
    {
        $this->dinner = $dinner;

        return $this;
    }
}
