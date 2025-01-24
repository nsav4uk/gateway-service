<?php

declare(strict_types=1);

namespace Gateway\UserService\Service;

use Gateway\UserService\Factory\UserFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class UserService
{
    public function __construct(
        private HttpClientInterface $client,
        private UserFactory $userFactory,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function createUser(array $data): array
    {
        $user = $this->userFactory->create($data);
        $password = $this->passwordHasher->hashPassword($user, $data['password']);

        $data = $this->client->request('POST', 'http://user.nginx/api/user', ['json' => [
            'email' => $data['email'],
            'password' => $password,
        ]]);

        return $data->toArray();
    }

    public function getUserByEmail(string $email): UserInterface
    {
        $data = $this->client->request('GET', 'http://user.nginx/api/user/{email}', [
            'vars' => ['email' => $email],
        ]);

        return $this->userFactory->create($data->toArray());
    }
}
