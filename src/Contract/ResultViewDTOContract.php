<?php

namespace App\Contract;

interface ResultViewDTOContract
{
    public function __construct(int $totalQuestionsCount, int $correctQuestionsCount, int $incorrectQuestionsCount, array $correctQuestions, array $incorrectQuestions);

    public function getTotalQuestionsCount(): int;

    public function getCorrectQuestionsCount(): int;

    public function getIncorrectQuestionsCount(): int;

    public function getCorrectQuestions(): array;

    public function getIncorrectQuestions(): array;
}