<?php

namespace App\Service;

use App\Entity\Quiz;
use App\Entity\Result;
use App\Entity\ResultItem;

use App\Service\QuizService;
use App\Service\ResultService;
use App\Service\ResultItemService;

class MathTestService
{
    private const MATH_TEST_ID = 1;

    private $quizService;
    private $resultService;
    private $resultItemService;

    public function __construct(QuizService $quizService, ResultService $resultService, ResultItemService $resultItemService)
    {
        $this->quizService = $quizService;
        $this->resultService = $resultService;
        $this->resultItemService = $resultItemService;
    }

    public function getMathTest(): ?Result
    {
        $quiz = $this->quizService->getWithRelationsByID(self::MATH_TEST_ID);

        if (!$quiz) {
            return null;
        }

        $result = $this->resultService->makeResultFromQuiz($quiz);

        $result->setQuiz($quiz);
        $resultItems = $this->resultItemService->makeResultItemsFromQuiz($quiz);
        $result->addResultItems($resultItems);
        return $result;
    }

    public function saveMathTestResults(array $array)
    {
        // return $this->quizService->getWithRelationsByID(self::MATH_TEST_ID);
    }
}
