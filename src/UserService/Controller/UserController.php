<?php

declare(strict_types=1);

namespace Gateway\UserService\Controller;

use Gateway\UserService\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user', methods: ['GET'])]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->json([
            'email' => $user->getUserIdentifier(),
        ]);
    }

    #[Route('/sign-up', name: 'sign-up', methods: ['POST'])]
    public function create(
        Request $request,
        UserService $userService,
    ): Response {
        return $this->json($userService->createUser($request->toArray()));
    }
}
