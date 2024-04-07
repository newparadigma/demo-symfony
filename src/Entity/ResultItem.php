<?php

namespace App\Entity;

use App\Repository\ResultItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultItemRepository::class)]
class ResultItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'resultItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Result $result = null;

    #[ORM\ManyToOne(inversedBy: 'resultItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuestionAnswer $questionAnswer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->created_at = new \DateTimeImmutable();
        $this->setUpdatedAtValue();
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updated_at = new \DateTimeImmutable();
    }

    public function getResult(): ?Result
    {
        return $this->result;
    }

    public function setResult(?Result $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getQuestionAnswer(): ?QuestionAnswer
    {
        return $this->questionAnswer;
    }

    public function setQuestionAnswer(?QuestionAnswer $questionAnswer): static
    {
        $this->questionAnswer = $questionAnswer;

        return $this;
    }
}
