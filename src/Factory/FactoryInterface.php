<?php

namespace Gateway\Factory;

interface FactoryInterface
{
    public function create(array $data): object;
}