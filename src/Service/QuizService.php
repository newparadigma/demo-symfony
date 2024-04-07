<?php

namespace App\Service;

use App\Entity\Quiz;
use App\Repository\QuizRepository;

class QuizService
{
    private $quizRepository;

    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function getWithRelationsByID(int $quizId): ?Quiz
    {
        return $this->quizRepository->getWithRelationsByID($quizId);
    }
}
