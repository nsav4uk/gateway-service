<?php

declare(strict_types=1);

namespace Gateway\UserService\Factory;

use Gateway\UserService\Entity\User;

class UserFactory implements FactoryInterface
{
    public function create(array $data): User
    {
        return new User(
            $data['id'] ?? null,
            $data['email'],
            $data['password'],
            $data['roles'] ?? [],
        );
    }
}
