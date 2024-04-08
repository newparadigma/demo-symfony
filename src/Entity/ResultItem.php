<?php

namespace App\Entity;

use App\Repository\ResultItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultItemRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ResultItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'resultItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Result $result = null;

    #[ORM\ManyToOne(inversedBy: 'resultItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?QuestionAnswer $questionAnswer = null;

    private ?bool $checked = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(?bool $checked): static
    {
        $this->checked = $checked;

        return $this;
    }
}
