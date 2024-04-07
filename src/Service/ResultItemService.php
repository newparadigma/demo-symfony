<?php

namespace App\Service;

use App\Entity\ResultItem;
use App\Entity\Quiz;

use App\Repository\ResultRepository;

class ResultItemService
{
    private $resultRepository;

    public function __construct(ResultRepository $resultRepository)
    {
        $this->resultRepository = $resultRepository;
    }

    public function makeResultItemsFromQuiz(Quiz $quiz): array
    {
        $resultItems = [];
        foreach ($quiz->getQuestions() as $question) {
            foreach ($question->getAnswers() as $answer) {
                $resultItem = new ResultItem();
                $resultItem->setQuestion($question);
                $resultItem->setAnswer($answer);
                // $answer->addResultItem($resultItem);
                $resultItems[] = $resultItem;
            }
        }

        return $resultItems;
    }
}
