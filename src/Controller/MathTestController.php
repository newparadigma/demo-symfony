<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\MathTestForm;


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
        $form = $this->createForm(MathTestForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Обработка отправленной формы
        }

        $quiz = $this->mathTestService->getQuiz();

        // dd($quiz->getQuestions());

        return $this->render('math_test/index.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }
}
