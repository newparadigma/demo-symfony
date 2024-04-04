<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResultController extends AbstractController
{
    #[Route('/result', name: 'app_result')]
    public function index(): Response
    {
        return $this->render('result/index.html.twig', [
            'controller_name' => 'ResultController',
        ]);
    }

    #[Route('/result/new', name: 'app_result_new')]
    public function new(): Response
    {
        // $quiz = 

        return $this->render('result/new.html.twig', [
            'controller_name' => 'ResultController',
        ]);
    }

    #[Route('/result/last', name: 'app_result_last')]
    public function last(): Response
    {
        return $this->render('result/last.html.twig', [
            'controller_name' => 'ResultController',
        ]);
    }
}
