<?php

declare(strict_types=1);

namespace Gateway\Service;

use Gateway\Factory\UserFactory;
use Gateway\Message\CreateUserMessage;
use Gateway\Message\GetUserByEmailMessage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserService
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus,
        private UserFactory $userFactory,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function createUser(array $data): array
    {
        $user = $this->userFactory->create($data);

        $password = $this->passwordHasher->hashPassword($user, $data['password']);

        return $this->handle(new CreateUserMessage($data['email'], $password));
    }

    public function getUserByEmail(string $email): UserInterface
    {
        try {
            $user = $this->handle(new GetUserByEmailMessage($email));
        } catch (HandlerFailedException) {
            throw new NotFoundHttpException('User not found');
        }

        return $this->userFactory->create($user);
    }
}
