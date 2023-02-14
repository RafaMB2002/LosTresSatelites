<?php

namespace App\Controller\FORM;

use App\Entity\Mensaje;
use App\Form\MensajeType;
use App\Repository\MensajeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MensajeFormController extends AbstractController
{
    private $mensajeRepository;

    public function __construct(MensajeRepository $mensajeRepository)
    {
        $this->mensajeRepository = $mensajeRepository;
    }

    #[Route('/mensaje/form', name: 'app_mensaje_form')]
    public function newMensaje(Request $request): Response
    {
        $mensaje = new Mensaje();

        $form = $this->createForm(MensajeType::class, $mensaje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mensaje = $form->getData();
            $this->mensajeRepository->saveMensaje($mensaje->getFechaHora(), false, $mensaje->getBandaId(), $mensaje->getModoId(), $mensaje->getIdUser());
            return $this->redirectToRoute('landing_page');
        }
        return $this->render('mensaje_form/index.html.twig', [
            'form' => $form,
        ]);
    }
}
