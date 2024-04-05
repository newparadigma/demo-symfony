<?php

namespace App\Service;

// use App\Entity\Order;
use App\Repository\QuizRepository;

class QuizService
{
    private const QUIZ_ID = 1;

    private $quizRepository;

    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function getWithRelationsByID()
    {
        $data = $this->quizRepository->getWithRelationsByID(self::QUIZ_ID);
        return $data;
    }
}
