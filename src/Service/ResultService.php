<?php

namespace App\Service;

use App\Repository\ResultRepository;

use App\Entity\Result;
use App\Entity\Quiz;

class ResultService
{
    private const QUIZ_ID = 1;

    private $resultRepository;

    public function __construct(ResultRepository $resultRepository)
    {
        $this->resultRepository = $resultRepository;
    }

    public function makeResultFromQuiz(Quiz $quiz): Result
    {
        $result = new Result();
        $result->setQuiz($quiz);

        return $result;
    }
}
