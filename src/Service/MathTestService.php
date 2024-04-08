<?php

namespace App\Service;

use App\Entity\Result;

use App\Service\QuizService;
use App\Service\ResultService;
use App\Service\ResultItemService;
use App\Service\AccountService;

class MathTestService
{
    private const MATH_TEST_ID = 1;

    private $quizService;
    private $resultService;
    private $resultItemService;
    private $accountService;

    public function __construct(QuizService $quizService, ResultService $resultService, ResultItemService $resultItemService, AccountService $accountService)
    {
        $this->quizService = $quizService;
        $this->resultService = $resultService;
        $this->resultItemService = $resultItemService;
        $this->accountService = $accountService;
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

    public function saveResult(Result $result): Result
    {
        foreach ($result->getResultItems() as $resultItem) {
            if (!$resultItem->getChecked()) {
                $result->removeResultItem($resultItem);
            }
        }

        $account = $this->accountService->getFakeAccountForResult();
        $result->setAccount($account);

        return $this->resultService->save($result);
    }

    public function getResultViewData(): ?array
    {
        $result = $this->resultService->getLastWithRelations();
        
        if ($result === null) {
            return null;
        }

        $viewData = [
            'totalQuestionsCount' => 0,
            'correctQuestions' => [],
            'correctQuestionsCount' => 0,
            'incorrectQuestions' => [],
            'incorrectQuestionsCount' => 0,
        ];

        $questionAnswerIds = [];
        foreach ($result->getResultItems() as $resultItem) {
            $questionAnswerIds[] = $resultItem->getQuestionAnswer()->getId();
        }

        foreach ($result->getQuiz()->getQuestions() as $question) {
            $correctAnswersExists = false;
            foreach ($question->getQuestionAnswers() as $questionAnswer) {
                if ($questionAnswer->getIsCorrect() && in_array($questionAnswer->getId(), $questionAnswerIds)) {
                    $correctAnswersExists = true;
                } else if (!$questionAnswer->getIsCorrect() && in_array($questionAnswer->getId(), $questionAnswerIds)) {
                    $viewData['incorrectQuestions'][] = $question;
                    continue(2);
                }
            }
            if ($correctAnswersExists) {
                $viewData['correctQuestions'][] = $question;
            } else {
                $viewData['incorrectQuestions'][] = $question;
            }
        }

        $viewData['totalQuestionsCount'] = count($result->getQuiz()->getQuestions());
        $viewData['correctQuestionsCount'] = count($viewData['correctQuestions']);
        $viewData['incorrectQuestionsCount'] = count($viewData['incorrectQuestions']);

        return $viewData;
    }
}
