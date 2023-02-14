<?php

namespace App\Controller\API;

use App\Entity\Banda;
use App\Repository\BandaRepository;
use App\Repository\MensajeRepository;
use App\Repository\ModoRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/mensaje', name: 'api_mensaje_')]
class ApiMensajeController
{
    private $mensajeRepository;
    private $bandaRepository;
    private $modoRepository;
    private $userRepository;

    public function __construct(MensajeRepository $mensajeRepository, BandaRepository $bandaRepository, ModoRepository $modoRepository, UserRepository $userRepository)
    {
        $this->mensajeRepository = $mensajeRepository;
        $this->bandaRepository = $bandaRepository;
        $this->modoRepository = $modoRepository;
        $this->userRepository = $userRepository;
    }

    #[Route('/add', name: 'add', methods: 'POST')]
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $fecha_hora = $data['fecha_hora'];
        $valido = $data['valido'];
        $banda_id = $data['banda_id_id'];
        $modo_id = $data['modo_id_id'];
        $user_id = $data['id_user_id'];

        if (empty($fecha_hora) || empty($valido) || empty($banda_id) || empty($modo_id) || empty($user_id)) {
            throw new NotFoundHttpException('Esperando parametros obligatorios!');
        }

        $mensaje = $this->mensajeRepository->saveMensaje($fecha_hora, $valido, $banda_id, $modo_id, $user_id);

        $data = [
            'status' => true,
            'object' => [$mensaje->toArray()]
        ];

        return new JsonResponse($data, Response::HTTP_CREATED);
    }

    #[Route('/get/{id}', name: 'get_one', methods: 'GET')]
    public function get($id): JsonResponse
    {
        try {

            $mensaje = $this->mensajeRepository->findOneBy(['id' => $id]);

            $data = [
                'result' => true,
                'object' => [
                    'id' => $mensaje->getId(),
                    'fecha_hora' => $mensaje->getFechaHora(),
                    'valido' => $mensaje->isValido(),
                    'banda_id' => $this->bandaRepository->findOneBy(['id' => $mensaje->getBandaId()])->getId(),
                    'modo_id' => $this->modoRepository->findOneBy(['id' => $mensaje->getModoId()])->getId(),
                    'user_id' => $this->userRepository->findOneBy(['id' => $mensaje->getIdUser()])->getId()
                ]
            ];
            $response = new JsonResponse($data, Response::HTTP_OK);
        } catch (\Throwable $th) {

            $data = [
                'result' => false
            ];

            $response = new JsonResponse($data, Response::HTTP_NOT_FOUND);
        }


        return $response;
    }

    #[Route("/getAll", name: "get_all", methods: "GET")]
    public function getAll(): JsonResponse
    {
        $mensajes = $this->mensajeRepository->findAll();
        $data = [];

        foreach ($mensajes as $mensaje) {
            $data[] = [
                'result' => true,
                'object' => [
                    'id' => $mensaje->getId(),
                    'fecha_hora' => $mensaje->getFechaHora(),
                    'valido' => $mensaje->isValido(),
                    'banda_id' => $this->bandaRepository->findOneBy(['id' => $mensaje->getBandaId()])->getId(),
                    'modo_id' => $this->modoRepository->findOneBy(['id' => $mensaje->getModoId()])->getId(),
                    'user_id' => $this->userRepository->findOneBy(['id' => $mensaje->getIdUser()])->getId(),
                ]
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route("/update/{id}", name: "update", methods: "PUT")]
    public function update($id, Request $request): JsonResponse
    {
        $mensaje = $this->mensajeRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        empty($data['fecha_hora']) ? true : $mensaje->setFechaHora($data['fecha_hora']);
        empty($data['valido']) ? true : $mensaje->setValido($data['valido']);
        empty($data['banda_id']) ? true : $mensaje->setBandaId($data['banda_id']);
        empty($data['modo_id']) ? true : $mensaje->setModoId($data['modo_id']);
        empty($data['user_id']) ? true : $mensaje->setIdUser($data['user_id']);

        $updatedMensaje = $this->mensajeRepository->updateMensaje($mensaje);

        $data = [
            "result" => true,
            "object" => $updatedMensaje->toArray()
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route("/delete/{id}", name: "delete", methods: "DELETE")]
    public function delete($id): JsonResponse
    {
        $mensaje = $this->mensajeRepository->findOneBy(['id' => $id]);

        $this->mensajeRepository->removeMesa($mensaje);
        $data = ["result" => true];
        return new JsonResponse($data, Response::HTTP_OK);
    }
}
