<?php

declare(strict_types=1);

namespace Gateway\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage]
readonly class CreateUserMessage
{
    public function __construct(
        private string $content,
    ) {}

    public function getContent(): string
    {
        return $this->content;
    }
}
