<?php
// src/Controller/UserController.php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/users-by-ekipa/{ekipaId}', name: 'users_by_ekipa', methods: ['GET'])]
    public function usersByEkipa($ekipa_id)
    {
    $users = $this->entityManager->getRepository(User::class)->findBy(['team' => $ekipa_id]);

    $response = [];
    foreach ($users as $user) {
        $response[] = [
            'key_id' => $user->getKeyId(),
            'id' => $user->getId(),
            'password' => $user->getPassword(),
            'admin' => $user->getAdmin(),
            'emial' => $user->getEmail(),
        ];
    }
    return new JsonResponse($response, Response::HTTP_CREATED, [
        'Content-Type' => 'application/json',
    ]);
    }

    #[Route("/login", name: "user_login", methods: ["POST"])]
    public function userLogin(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $userId = $data['id'] ?? null;
        $password = $data['password'] ?? null;

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $userId]);

        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], 404);
        }

        if ($password !== $user->getPassword()) {
            return new JsonResponse(['message' => 'Wrong password'], 401);
        }

        return $this->json($user);
    }
    
    
}



