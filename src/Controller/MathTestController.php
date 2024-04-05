<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\QuizType;

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
        $quiz = $this->mathTestService->getQuiz();

        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Обработка данных формы, например сохранение в базу данных
            $requestData = $request->request->all();
            dd($requestData);
            // ... действия по обработке данных ...

            // Перенаправление на другую страницу или что-то еще
            return $this->redirectToRoute('your_success_route');
        }

        return $this->render('math_test/index.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }
}
