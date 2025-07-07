<?php

namespace Ngomafortuna\Apireceiver;

interface APIClientInterface
{
    public function get(): object;
    public function patch(array $data): object;
}
