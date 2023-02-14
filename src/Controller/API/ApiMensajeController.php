<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiMensajeController extends AbstractController
{
    #[Route('/api/mensaje', name: 'app_api_mensaje')]
    public function index(): Response
    {
        return $this->render('api_mensaje/index.html.twig', [
            'controller_name' => 'ApiMensajeController',
        ]);
    }
}
