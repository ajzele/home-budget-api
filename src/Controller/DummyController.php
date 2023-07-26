<?php

namespace App\Controller;

use App\Entity\Dummy;
use App\OptionsResolver\DummyOptionsResolver;
use App\Repository\DummyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\OptionsResolver\PaginatorOptionsResolver;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route("/api", "api_", format: "json")]
class DummyController extends AbstractController
{
    #[Route('/dummies', name: 'dummies', methods: ["GET"])]
    public function index(
        DummyRepository          $dummyRepository,
        Request                  $request,
        PaginatorOptionsResolver $paginatorOptionsResolver
    ): JsonResponse
    {
        try {
            $queryParams = $paginatorOptionsResolver
                ->configurePage()
                ->resolve($request->query->all());

            $dummies = $dummyRepository->findAllWithPagination($queryParams['page']);

            return $this->json($dummies);
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    #[Route("/dummies/{id}", "get_dummy", methods: ["GET"])]
    public function getTodo(
        Dummy $dummy
    ): JsonResponse
    {
        return $this->json($dummy);
    }

    #[Route("/dummies", "create_dummy", methods: ["POST"])]
    public function createDummy(
        Request                $request,
        ValidatorInterface     $validator,
        DummyOptionsResolver   $dummyOptionsResolver,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        try {
            $requestBody = json_decode($request->getContent(), true);

            $fields = $dummyOptionsResolver
                ->configureTitle(true)
                ->configureEnabled(true)
                ->resolve($requestBody);

            $dummy = new Dummy();
            $dummy->setTitle($fields['title']);
            $dummy->setEnabled($fields['enabled']);

            $errors = $validator->validate($dummy);
            if (count($errors) > 0) {
                throw new \InvalidArgumentException((string)$errors);
            }

            $entityManager->flush();

            return $this->json($dummy, status: Response::HTTP_CREATED);
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    #[Route("/dummies/{id}", "update_dummy", methods: ["PATCH", "PUT"])]
    public function updateDummy(
        Dummy                  $dummy,
        Request                $request,
        DummyOptionsResolver   $dummyOptionsResolver,
        ValidatorInterface     $validator,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        try {
            $requestBody = json_decode($request->getContent(), true);
            $isPutMethod = $request->getMethod() === "PUT";

            $fields = $dummyOptionsResolver
                ->configureTitle($isPutMethod)
                ->configureEnabled($isPutMethod)
                ->resolve($requestBody);

            foreach ($fields as $field => $value) {
                switch ($field) {
                    case 'title':
                        $dummy->setTitle($value);
                        break;
                    case 'enabled':
                        $dummy->setEnabled($value);
                        break;
                }
            }

            $errors = $validator->validate($dummy);
            if (count($errors) > 0) {
                throw new \InvalidArgumentException((string)$errors);
            }

            $entityManager->flush();

            return $this->json($dummy, status: Response::HTTP_CREATED);
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    #[Route("/dummies/{id}", "delete_dummy", methods: ["DELETE"])]
    public function deleteDummy(
        Dummy                  $dummy,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $entityManager->remove($dummy);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
