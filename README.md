# APIReceiver
Professional API consumer/receiver (Consudor profissional de API)

This component have two features (Suported methods):
- GET (to get all - para receber todos)
- PATCH (to get one - para receber um)
- POST (add new element - adicionar novo elemento)
- PUT (update one elemet - actualizar um alemento)
- DELETE (delete one element - eliminar um elemento)

## Important
All methods return object, if no receive data in 10 s, or to happen one error return `object`:
```shell
class stdClass#5 (1) {
  public $error => string(71) "message of error"
}
```

## Require
Necessary PHP 8.0 or more (Necessário PHP 8.0 ou superior)

## Install
composer require ngomafortuna/number-formatter

## Syntax and mode of use
```php
$client = new CurlAPIClient($url);

var_dump($client->get());
```

## Example
```php
use Ngomafortuna\Apireceiver\CurlAPIClient;

require_once PATH . '/vendor/autoload.php';

$url = "url/api"; // set url

$client = new CurlAPIClient($url);

// GET
var_dump($client->get()); 

// PATCH 
$data = ['id' => 29];
var_dump($client->patch($data));

// POST 
$data = [
    'name' => 'Minha Rosa',
    'email' => 'minha.rosa@lovecorp.ao' 
  ];
var_dump($client->post($data));

// PUT 
$data = [
    'id' => 30,
    'name' => 'Minha Rosa Updated',
    'email' => 'minha.rosa@lovecorp.ao'  
  ];
var_dump($client->put($data));

// DELETE
$data = ['id' => 30];
var_dump($client->delete($data));

```

Results
```shell
// GET result
class stdClass#32 (27) {
  public $0 => class stdClass#5 (3) {
    public $id => int(27)
    public $name => string(13) "Ngoma Fortuna"
    public $email => string(21) "ngoma.fortuna@mtec.ao"
  }
  public $1 => class stdClass#6 (3) {
    public $id => int(28)
    public $name => string(12) "Rosa Fortuna"
    public $email => string(20) "rosa.fortuna@mtec.ao"
  }
  public $2 => class stdClass#7 (3) {
    public $id => int(29)
    public $name => string(17) "Lucrécia Fortuna"
    public $email => string(24) "lucrecia.fortuna@mtec.ao"
  }
}
...

// PATCH
class stdClass#5 (3) {
  public $id => int(29)
  public $name => string(17) "Lucrécia Fortuna"
  public $email => string(24) "lucrecia.fortuna@mtec.ao"
}

// POST
class stdClass#5 (1) {
  public $message => string(25) "User created successfully"
}

// PUT
class stdClass#5 (1) {
  public $message => string(25) "User updated successfully"
}

// DELETE
class stdClass#5 (1) {
  public $message => string(25) "User deleted successfully"
}

```