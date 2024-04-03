<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizRepository::class)]
class Quiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $randomize_questions = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isRandomizeQuestions(): ?bool
    {
        return $this->randomize_questions;
    }

    public function setRandomizeQuestions(bool $randomize_questions): static
    {
        $this->randomize_questions = $randomize_questions;

        return $this;
    }
}
