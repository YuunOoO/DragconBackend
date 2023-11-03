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

    $groupedTasks = [
        'Backlog' => [],
        'InProgress' => [],
        'Done' => [],
    ];

    foreach ($tasks as $task) {
        $taskData = [
            'task_id' => $task->getTaskId(),
            'about' => $task->getAbout(),
            'data_reg' => $task->getDataReg()->format('Y-m-d H:i:s'),
            'time_exec' => $task->getTimeExec()->format('Y-m-d H:i:s'),
            'type' => $task->getType(),
            'priority' => $task->getPriority(),
        ];

        $type = $task->getType();

        if ($type === 'Backlog') {
            $groupedTasks['Backlog'][] = $taskData;
        } elseif ($type === 'InProgress') {
            $groupedTasks['InProgress'][] = $taskData;
        } elseif ($type === 'Done') {
            $groupedTasks['Done'][] = $taskData;
        }

    }
    return new JsonResponse($groupedTasks, Response::HTTP_CREATED, [
        'Content-Type' => 'application/json',
    ]);
    }
    
}



