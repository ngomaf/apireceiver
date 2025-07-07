<?php

namespace Ngomafortuna\Apireceiver;

class CurlAPIClient implements APIClientInterface
{
    private $channel;

    public function __construct(public string $url) {
        $this->channel = curl_init($this->url);
        curl_setopt($this->channel, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->channel, CURLOPT_CONNECTTIMEOUT, 5); // 5 time of connection in secound
        curl_setopt($this->channel, CURLOPT_TIMEOUT, 10);       // 10 time f requisition in secound
    }

    public function get(): object
    {
        $response = curl_exec($this->channel);
        curl_close($this->channel);

        return $this->decodeResponse($response, curl_error($this->channel));
    }

    public function patch(array $data): object
    {
        curl_setopt($this->channel, CURLOPT_CUSTOMREQUEST, "PATCH"); // PATCH method
        curl_setopt($this->channel, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($this->channel, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($this->channel);
        curl_close($this->channel);

        return $this->decodeResponse($response, curl_error($this->channel));
    }

    public function post(array $data): object
    {
        curl_setopt($this->channel, CURLOPT_POST, true); // POST method
        curl_setopt($this->channel, CURLOPT_POSTFIELDS, json_encode($data)); // body of requisition
        curl_setopt($this->channel, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($this->channel);
        curl_close($this->channel);

        return $this->decodeResponse($response, curl_error($this->channel));
    }

    public function put(array $data): object
    {
        curl_setopt($this->channel, CURLOPT_CUSTOMREQUEST, "PUT"); // PUT method
        curl_setopt($this->channel, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($this->channel, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($this->channel);
        curl_close($this->channel);

        return $this->decodeResponse($response, curl_error($this->channel));
    }

    public function delete(array $data): object
    {
        curl_setopt($this->channel, CURLOPT_CUSTOMREQUEST, "DELETE"); // DELETE method
        curl_setopt($this->channel, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($this->channel);
        curl_close($this->channel);

        return $this->decodeResponse($response, curl_error($this->channel));
    }

    private function decodeResponse(string $response, ?string $error=null): object
    {
        if($error) return (object)['error' => $error];
            
        return ($response)? (object)json_decode($response): (object)['error' => 'Connetion error'];
    }
}
