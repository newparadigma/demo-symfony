<?php

namespace App\Service;

use App\Entity\Quiz;
use App\Entity\Result;
use App\Entity\ResultItem;

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

    public function saveResult(Result $result, array $requestData): Result
    {
        $checkedResultItems = $requestData['result_result_item']['cheked'];
        foreach ($result->getResultItems() as $resultItem) {
            if (!in_array($resultItem->getId(), $checkedResultItems)) {
                $result->removeResultItem($resultItem);
            }
        }

        $account = $this->accountService->getFakeAccountForResult();
        $result->setAccount($account);

        return $this->resultService->save($result);
    }
}
