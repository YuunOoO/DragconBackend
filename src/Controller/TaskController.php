<?php
// src/Controller/TaskController.php

namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class TaskController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/tasks-by-ekipa/{ekipaId}', name: 'tasks_by_ekipa', methods: ['GET'])]
    public function tasksByEkipa($ekipa_id)
    {
    $tasks = $this->entityManager->getRepository(Task::class)->findBy(['team' => $ekipa_id], ['priority' => 'ASC']);

    $taskList = [];
    foreach ($tasks as $task) {
        $taskData = [
            'task_id' => $task->getTaskId(),
            'about' => $task->getAbout(),
            'data_reg' => $task->getDataReg()->format('Y-m-d H:i:s'),
            'time_exec' => $task->getTimeExec() !== null ? $task->getTimeExec()->format('Y-m-d H:i:s') : null,
            'type' => $task->getType(),
            'priority' => $task->getPriority(),
            'location' => $task->getLocation(),
            'ekipa_id' => $ekipa_id,
        ];
        $taskList[] = $taskData;


    }
    return new JsonResponse($taskList, Response::HTTP_CREATED, [
        'Content-Type' => 'application/json',
    ]);
    }
    
}



