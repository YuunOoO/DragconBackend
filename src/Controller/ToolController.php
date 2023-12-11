<?php
// src/Controller/ToolController.php

namespace App\Controller;

use App\Entity\Tool;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class ToolController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/tools-by-ekipa/{ekipaId}', name: 'tools_by_ekipa', methods: ['GET'])]
    public function toolsByEkipa($ekipa_id)
    {
    $tools = $this->entityManager->getRepository(Tool::class)->findBy(['team' => $ekipa_id]);

    $response = [];
    foreach ($tools as $tool) {
        $response[] = [
            'tool_id' => $tool->getToolId(),
            'amount' => $tool->getAmount(),
            'mark' => $tool->getMark(),
            'type' => $tool->getType(),
            'ekipaId' => $ekipa_id,
            'teamName' => $tool->getTeamName(),
        ];
    }
    return new JsonResponse($response, Response::HTTP_CREATED, [
        'Content-Type' => 'application/json',
    ]);
    }
    
}
