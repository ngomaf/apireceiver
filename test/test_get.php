<?php

use Ngomafortuna\Apireceiver\CurlAPIClient;

require_once "config.php";

echo PHP_EOL . PHP_EOL;
// $url = "http://127.0.0.1:8105/api/user";
$url = "https://reqres.in/api/users?page=2";

$client = new CurlAPIClient($url);

var_dump($client->get());