<?php

declare(strict_types=1);

namespace Gateway\MessageHandler;

use Gateway\Message\CreateUserMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsMessageHandler]
readonly class CreateUserMessageHandler
{
    public function __construct(
        private HttpClientInterface $client,
    ) {}

    public function __invoke(CreateUserMessage $message): array
    {
        $data = $this->client->request('POST', 'http://user.nginx/', ['body' => $message->getContent()]);

        return $data->toArray();
    }
}
