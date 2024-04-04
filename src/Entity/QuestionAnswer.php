<?php

namespace App\Entity;

use App\Repository\QuestionAnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionAnswerRepository::class)]
class QuestionAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'questionAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Answer $answer = null;

    #[ORM\ManyToOne(inversedBy: 'questionAnswers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Question $question = null;

    #[ORM\Column]
    private ?bool $isCorrectAnswer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(?Answer $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getIsCorrectAnswer(): ?bool
    {
        return $this->isCorrectAnswer;
    }

    public function setIsCorrectAnswer(bool $isCorrectAnswer): static
    {
        $this->isCorrectAnswer = $isCorrectAnswer;

        return $this;
    }
}
