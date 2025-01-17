<?php

declare(strict_types=1);

namespace Gateway\MessageHandler;

use Gateway\Message\GetUserByEmailMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsMessageHandler]
readonly class GetUserByEmailMessageHandler
{
    public function __construct(
        private HttpClientInterface $client,
    ) {}

    public function __invoke(GetUserByEmailMessage $message)
    {
        $data = $this->client->request('GET', 'http://user.nginx/' . $message->getEmail());

        return $data->toArray();
    }
}
