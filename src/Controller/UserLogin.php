<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsController]
class UserLogin extends AbstractController
{
    public function __invoke(
        Request                     $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserRepository              $userRepository,
        EntityManagerInterface      $entityManager
    ): JsonResponse
    {
        $data = \json_decode($request->getContent(), true);

        $user = $userRepository->findOneBy(['email' => $data['email'] ?? null]);

        if ($user) {
            $authenticated = $userPasswordHasher->isPasswordValid($user, $data['password'] ?? null);
            if ($authenticated) {
                $user->setToken(\bin2hex(random_bytes(18)));
                $entityManager->flush();
                return new JsonResponse([
                    'message' => 'Authentication successful',
                    'token' => $user->getToken(),
                ]);
            }
        }

        return new JsonResponse([
            'message' => 'Authentication failed',
            'token' => null,
        ], 401);
    }
}
