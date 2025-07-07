<?php

namespace Ngomafortuna\Apireceiver;

trait HTTPMsgTrait
{
    public static function get(int $status): string
    {
        return match($status) { 
            200 => "OK (Success)",
            201 => "Created",
            204 => "No Content",
            400 => "Bad Request", // Requisição malformada
            401 => "Unauthorized",
            403 => "Forbidden", // Proibido
            404 => "Not Found",
            500 => "Internal Server Error"
        };
    }

}
