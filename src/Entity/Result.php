<?php

namespace App\Entity;

use App\Repository\ResultRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Result
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[Assert\Type(type: Quiz::class)]
    // #[Assert\Valid]
    #[ORM\ManyToOne(inversedBy: 'results')]
    private ?Quiz $quiz = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(targetEntity: ResultItem::class, mappedBy: 'result', cascade: ['persist'])]
    private Collection $resultItems;

    #[ORM\ManyToOne(inversedBy: 'results')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Account $account = null;

    public function __construct()
    {
        $this->resultItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): static
    {
        $this->quiz = $quiz;

        return $this;
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
            $resultItem->setResult($this);
        }

        return $this;
    }

    public function addResultItems(array $resultItems): static
    {
        foreach ($resultItems as $resultItem) {
            $this->addResultItem($resultItem);
        }

        return $this;
    }

    public function setResultItems(array $resultItems): static
    {
        $this->resultItems = new ArrayCollection($resultItems);
        
        return $this;
    }

    public function removeResultItem(ResultItem $resultItem): static
    {
        if ($this->resultItems->removeElement($resultItem)) {
            // set the owning side to null (unless already changed)
            if ($resultItem->getResult() === $this) {
                $resultItem->setResult(null);
            }
        }

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): static
    {
        $this->account = $account;

        return $this;
    }
}
