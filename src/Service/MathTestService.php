<?php

namespace App\Service;

use App\Entity\Result;
use App\DTO\ResultViewDTO;

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

    public function getResultViewData(): ?ResultViewDTO
    {
        $result = $this->resultService->getLastWithRelations();

        if ($result === null) {
            return null;
        }

        $questionAnswerIds = [];
        foreach ($result->getResultItems() as $resultItem) {
            $questionAnswerIds[] = $resultItem->getQuestionAnswer()->getId();
        }

        $incorrectQuestions = [];
        $correctQuestions = [];

        foreach ($result->getQuiz()->getQuestions() as $question) {
            foreach ($question->getQuestionAnswers() as $questionAnswer) {
                if ($questionAnswer->getIsCorrect() && !in_array($questionAnswer->getId(), $questionAnswerIds)) {
                    $incorrectQuestions[] = $question;
                    continue(2);
                } else if (!$questionAnswer->getIsCorrect() && in_array($questionAnswer->getId(), $questionAnswerIds)) {
                    $incorrectQuestions[] = $question;
                    continue(2);
                }
            }
            $correctQuestions[] = $question;
        }

        return new ResultViewDTO(
            $totalQuestionsCount = count($result->getQuiz()->getQuestions()),
            $correctQuestionsCount = count($correctQuestions),
            $incorrectQuestionsCount = count($incorrectQuestions),
            $correctQuestions = $correctQuestions,
            $incorrectQuestions = $incorrectQuestions
        );
    }
}
