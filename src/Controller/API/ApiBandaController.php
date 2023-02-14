<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiBandaController extends AbstractController
{
    #[Route('/api/banda', name: 'app_api_banda')]
    public function index(): Response
    {
        return $this->render('api_banda/index.html.twig', [
            'controller_name' => 'ApiBandaController',
        ]);
    }
}
