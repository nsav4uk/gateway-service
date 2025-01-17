<?php

declare(strict_types=1);

namespace Gateway\Factory;

use Gateway\Entity\User;

class UserFactory implements FactoryInterface
{
    public function create(array $data): object
    {
        return new User(
            $data['id'] ?? null,
            $data['email'],
            $data['password'],
        );
    }
}
