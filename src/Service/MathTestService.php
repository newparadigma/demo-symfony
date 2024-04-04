<?php

namespace App\Service;

use App\Service\QuizService;

class MathTestService
{
    private const QUIZ_ID = 1;

    private $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    public function getQuiz()
    {
        $quiz = $this->quizService->getWithRelationsByID();
        dd($quiz);
    }
}
