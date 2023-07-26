<?php

namespace App\Controller;

use App\Repository\DummyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api", "api_")]
class DummyController extends AbstractController
{
    #[Route('/dummy', name: 'app_dummy')]
    public function index(
        DummyRepository $dummyRepository
    ): JsonResponse
    {
        return $this->json($dummyRepository->findAll());
    }
}
