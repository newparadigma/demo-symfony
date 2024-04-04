<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Service\MathTestService;

class MathTestController extends AbstractController
{

    private $mathTestService;

    public function __construct(MathTestService $mathTestService)
    {
        $this->mathTestService = $mathTestService;
    }

    #[Route('/math/test', name: 'app_math_test')]
    public function index(): Response
    {
        $quiz = $this->mathTestService->getQuiz();
        dd($quiz);

        return $this->render('math_test/index.html.twig', [
            'controller_name' => 'MathTestController',
        ]);
    }
}
