<?php

use Ngomafortuna\Apireceiver\CurlAPIClient;

require_once "config.php";

echo PHP_EOL . PHP_EOL;

$url = "http://127.0.0.1:8105/api/user";

$client = new CurlAPIClient($url);

$data = ['id' => 39];

var_dump($client->delete($data));