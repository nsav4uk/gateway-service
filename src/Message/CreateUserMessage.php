<?php

declare(strict_types=1);

namespace Gateway\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage]
readonly class CreateUserMessage
{
    public function __construct(
        private string $email,
        private string $password,
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
