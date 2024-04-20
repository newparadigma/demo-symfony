<?php

namespace App\DTO;

use App\Contract\ResultViewDTOContract;

class ResultViewDTO implements ResultViewDTOContract
{
    private int $totalQuestionsCount;
    private int $correctQuestionsCount;
    private int $incorrectQuestionsCount;
    private array $correctQuestions;
    private array $incorrectQuestions;

    public function __construct(int $totalQuestionsCount, int $correctQuestionsCount, int $incorrectQuestionsCount, array $correctQuestions, array $incorrectQuestions)
    {
        $this->totalQuestionsCount = $totalQuestionsCount;
        $this->correctQuestionsCount = $correctQuestionsCount;
        $this->incorrectQuestionsCount = $incorrectQuestionsCount;
        $this->correctQuestions = $correctQuestions;
        $this->incorrectQuestions = $incorrectQuestions;
    }

    public function getTotalQuestionsCount(): int
    {
        return $this->totalQuestionsCount;
    }

    public function getCorrectQuestionsCount(): int
    {
        return $this->correctQuestionsCount;
    }

    public function getIncorrectQuestionsCount(): int
    {
        return $this->incorrectQuestionsCount;
    }

    public function getCorrectQuestions(): array
    {
        return $this->correctQuestions;
    }

    public function getIncorrectQuestions(): array
    {
        return $this->incorrectQuestions;
    }
}