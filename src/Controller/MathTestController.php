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

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $mathTest = $this->mathTestService->getMathTest();
        
        if ($mathTest === null) {
            return $this->render('math_test/index.html.twig');
        }

        $form = $this->createForm(ResultType::class, $mathTest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $form->getData();

            $mathTest = $this->mathTestService->saveResult($result);

            return $this->redirectToRoute('result');
        }

        return $this->render('math_test/index.html.twig', [
            'mathTest' => $mathTest,
            'form' => $form
        ]);
    }

    #[Route('/result', name: 'result')]
    public function result(): Response
    {
        $viewData = $this->mathTestService->getResultViewData();

        return $this->render('math_test/result.html.twig', [
            'viewData' => $viewData
        ]);
    }
}
