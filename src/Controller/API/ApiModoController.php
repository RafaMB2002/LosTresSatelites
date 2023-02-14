<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiModoController extends AbstractController
{
    #[Route('/api/modo', name: 'app_api_modo')]
    public function index(): Response
    {
        return $this->render('api_modo/index.html.twig', [
            'controller_name' => 'ApiModoController',
        ]);
    }
}
