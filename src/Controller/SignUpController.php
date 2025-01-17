<?php

declare(strict_types=1);

namespace Gateway\Controller;

use Gateway\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SignUpController extends AbstractController
{
    #[Route('/sign-up', name: 'sign-up', methods: ['POST'])]
    public function index(
        Request $request,
        UserService $userService,
    ): Response {
        return $this->json($userService->createUser($request->toArray()));
    }
}
