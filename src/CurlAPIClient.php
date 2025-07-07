<?php

namespace Ngomafortuna\Apireceiver;

class CurlAPIClient implements APIClientInterface
{
    private $channel;

    public function __construct(public string $url) {
        $this->channel = curl_init($this->url);
        curl_setopt($this->channel, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->channel, CURLOPT_CONNECTTIMEOUT, 10); // 5 time of connection in secound
        curl_setopt($this->channel, CURLOPT_TIMEOUT, 15);        // 10 time f requisition in secound
    }

    public function get(): object
    {
        $response = curl_exec($this->channel);
        $httpCode = curl_getinfo($this->channel, CURLINFO_HTTP_CODE);
        curl_close($this->channel);

        return $this->decodeResponse($response, $httpCode, curl_error($this->channel));
    }

    public function patch(array $data): object
    {
        curl_setopt($this->channel, CURLOPT_CUSTOMREQUEST, "PATCH"); // PATCH method
        curl_setopt($this->channel, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($this->channel, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($this->channel);
        $httpCode = curl_getinfo($this->channel, CURLINFO_HTTP_CODE);
        curl_close($this->channel);

        return $this->decodeResponse($response, $httpCode, curl_error($this->channel));
    }

    public function post(array $data): object
    {
        curl_setopt($this->channel, CURLOPT_POST, true); // POST method
        curl_setopt($this->channel, CURLOPT_POSTFIELDS, json_encode($data)); // body of requisition
        curl_setopt($this->channel, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($this->channel);
        $httpCode = curl_getinfo($this->channel, CURLINFO_HTTP_CODE);
        curl_close($this->channel);

        return $this->decodeResponse($response, $httpCode, curl_error($this->channel));
    }

    public function put(array $data): object
    {
        curl_setopt($this->channel, CURLOPT_CUSTOMREQUEST, "PUT"); // PUT method
        curl_setopt($this->channel, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($this->channel, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($this->channel);
        $httpCode = curl_getinfo($this->channel, CURLINFO_HTTP_CODE);
        curl_close($this->channel);

        return $this->decodeResponse($response, $httpCode, curl_error($this->channel));
    }

    public function delete(array $data): object
    {
        curl_setopt($this->channel, CURLOPT_CUSTOMREQUEST, "DELETE"); // DELETE method
        curl_setopt($this->channel, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($this->channel);
        $httpCode = curl_getinfo($this->channel, CURLINFO_HTTP_CODE);
        curl_close($this->channel);

        return $this->decodeResponse($response, $httpCode, curl_error($this->channel));
    }

    private function decodeResponse(string $response, int $status, ?string $error=null): object
    {
        if($status == 200 || $status == 201) {
            return (object) [
                'data' => (object) json_decode($response),
                'status' => (object) [
                    'number' => $status,
                    'message' => static::getHTTPMsg($status)
                ]
            ];
        }
        $error = empty($error)? static::getHTTPMsg($status): $error;
        return (object) ['status' => (object) ['number' => $status, 'message' => $error]];
    }

    public static function getHTTPMsg(int $status): string
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
