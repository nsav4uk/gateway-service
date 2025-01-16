<?php

declare(strict_types=1);

namespace Gateway\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage]
readonly class GetUserByEmailMessage
{
    public function __construct(
        private string $email,
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }
}
