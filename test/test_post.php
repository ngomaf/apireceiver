<?php

use Ngomafortuna\Apireceiver\CurlAPIClient;

require_once "config.php";

echo PHP_EOL . PHP_EOL;

$url = "http://127.0.0.1:8105/api/user";

$client = new CurlAPIClient($url);

$data = [
    'name' => 'Blabla do Bla',
    'email' => 'blabla.bla@mtec.ao' 
];

var_dump($client->post($data));