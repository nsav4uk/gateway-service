<?php

declare(strict_types=1);

namespace Gateway\UserService\Security;

use Gateway\UserService\Entity\User;
use Gateway\UserService\Service\UserService;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

readonly class UserProvider implements UserProviderInterface
{
    public function __construct(
        private UserService $userService,
    ) {}

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->userService->getUserByEmail($identifier);
    }
}
