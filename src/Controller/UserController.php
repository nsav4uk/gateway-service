<?php

declare(strict_types=1);

namespace Gateway\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
