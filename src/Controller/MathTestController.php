<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\MathTest\ResultType;

use App\Service\MathTestService;

class MathTestController extends AbstractController
{
    private $mathTestService;

    public function __construct(MathTestService $mathTestService)
    {
        $this->mathTestService = $mathTestService;
    }

    #[Route('/math/test', name: 'app_math_test')]
    public function index(Request $request): Response
    {
        $mathTest = $this->mathTestService->getMathTest();

        if ($mathTest === null) {
            return $this->render('math_test/index.html.twig');
        }

        $form = $this->createForm(ResultType::class, $mathTest);
        $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        if ($form->isSubmitted()) {
            $result = $form->getData();

            $requestData = $request->request->all();
            $mathTest = $this->mathTestService->saveResult($result, $requestData);

            return $this->redirectToRoute('app_math_test_result');
        }

        return $this->render('math_test/index.html.twig', [
            'mathTest' => $mathTest,
            'form' => $form
        ]);
    }

    #[Route('/math/test/result', name: 'app_math_test_result')]
    public function result(): Response
    {
        $result = $this->mathTestService->getLastResult();
        if ($result === null) {
            return $this->render('math_test/result.html.twig');
        }

        $viewData = [
            'totalQuestionsCount' => 0,
            'correctQuestions' => [],
            'correctQuestionsCount' => [],
            'incorrectQuestions' => [],
            'incorrectQuestionsCount' => [],
        ];


        foreach ($result->getQuiz()->getQuestions() as $question) {
            foreach ($question->getQuestionAnswers() as $questionAnswer) {
                if ($questionAnswer->getIsCorrect() && $questionAnswer->getResultItems()->count() !== 1) {
                    $viewData['incorrectQuestions'][] = $question;
                    continue(2);
                } else if (!$questionAnswer->getIsCorrect() && $questionAnswer->getResultItems()->count() === 1) {
                    $viewData['incorrectQuestions'][] = $question;
                    continue(2);
                }
            }
            $viewData['correctQuestions'][] = $question;
        }

        $viewData['totalQuestionsCount'] = count($result->getQuiz()->getQuestions());
        $viewData['correctQuestionsCount'] = count($viewData['correctQuestions']);
        $viewData['incorrectQuestionsCount'] = count($viewData['incorrectQuestions']);

        return $this->render('math_test/result.html.twig', [
            'viewData' => $viewData
        ]);
    }
}
