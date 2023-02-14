<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'landing_page')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/gestionMensajes', name: 'gestion_mensajes')]
    public function gestionMensajes():Response
    {
        return $this->render('mensaje_form/index.html.twig');
    }

    #[Route('/gestionMensajesJS', name: 'gestion_mensajesJS')]
    public function gestionMensajesJS():Response
    {
        return $this->render('mensajeJS/mensajeJS.html.twig');
    }
}
