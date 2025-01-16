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
use Symfony\Component\Security\Core\User\UserInterface;

class UserService
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus,
        private UserFactory $userFactory
    ) {}

    public function createUser(string $content): array
    {
        return $this->handle(new CreateUserMessage($content));
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
