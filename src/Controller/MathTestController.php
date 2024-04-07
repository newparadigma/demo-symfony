<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\ResultType;

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

        if ($form->isSubmitted() && $form->isValid()) {
            $requestData = $request->request->all();
            dd($requestData);

            return $this->redirectToRoute('app_math_test_results');
        }

        return $this->render('math_test/index.html.twig', [
            'mathTest' => $mathTest,
            'form' => $form->createView()
        ]);
    }

    // #[Route('/math/test/results', name: 'app_math_test_results')]
    // public function results(Request $request): Response
    // {
    //     $quiz = $this->mathTestService->getQuiz();

    //     $form = $this->createForm(QuizType::class, $quiz);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $requestData = $request->request->all();
    //         $this->mathTestService->saveMathTestResults($requestData);

    //         return $this->redirectToRoute('your_success_route');
    //     }

    //     return $this->render('math_test/index.html.twig', [
    //         'quiz' => $quiz,
    //         'form' => $form->createView(),
    //     ]);
    // }
}
