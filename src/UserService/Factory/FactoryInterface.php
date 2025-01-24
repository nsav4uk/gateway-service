<?php

namespace Gateway\UserService\Factory;

interface FactoryInterface
{
    public function create(array $data): object;
}