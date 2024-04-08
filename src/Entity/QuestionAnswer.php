<?php

namespace App\Entity;

use App\Repository\QuestionAnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionAnswerRepository::class)]
class QuestionAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isCorrect = null;

    #[ORM\ManyToOne(inversedBy: 'questionAnswers')]
    private ?Question $question = null;

    #[ORM\ManyToOne(inversedBy: 'questionAnswers')]
    private ?Answer $answer = null;

    #[ORM\OneToMany(targetEntity: ResultItem::class, mappedBy: 'questionAnswer')]
    private Collection $resultItems;

    public function __construct()
    {
        $this->resultItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsCorrect(): ?bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): static
    {
        $this->isCorrect = $isCorrect;

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

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(?Answer $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @return Collection<int, ResultItem>
     */
    public function getResultItems(): Collection
    {
        return $this->resultItems;
    }

    public function addResultItem(ResultItem $resultItem): static
    {
        if (!$this->resultItems->contains($resultItem)) {
            $this->resultItems->add($resultItem);
            $resultItem->setQuestionAnswer($this);
        }

        return $this;
    }

    public function removeResultItem(ResultItem $resultItem): static
    {
        if ($this->resultItems->removeElement($resultItem)) {
            // set the owning side to null (unless already changed)
            if ($resultItem->getQuestionAnswer() === $this) {
                $resultItem->setQuestionAnswer(null);
            }
        }

        return $this;
    }
}
