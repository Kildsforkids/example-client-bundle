<?php

namespace Kildsforkids\ExampleClientBundle\Service;

use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ExampleClient
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchComments(): array
    {
        $dataPath = __DIR__.'/../../data/example.json';
        $data = json_decode(file_get_contents($dataPath), true);

        $content = $data;

        try {
            $response = $this->client->request(
                'GET',
                'http://example.com/comments'
            );
            $content = $response->toArray();
        } catch (Exception $ex) {
            echo 'GET request to example.com/comments failed';
        }

        return $content;
    }

    public function addComment(string $name, string $text): array
    {
        $content = [
            'id' => 1,
            'name' => $name,
            'text' => $text
        ];

        try {
            $response = $this->client->request(
                'POST',
                'http://example.com/comment',
                [
                    'body' => [
                        'name' => $name,
                        'text' => $text
                    ]
                ]
            );
            $content = $response->toArray();
        } catch (Exception $ex) {
            echo 'POST request to example.com/comment failed';
        }

        return $content;
    }

    public function updateComment(int $id, array $payload): array
    {
        $content = array_merge(['id' => $id], $payload);

        try {
            $response = $this->client->request(
                'PUT',
                'http://example.com/comment',
                [
                    'body' => $payload
                ]
            );
            $content = $response->toArray();
        } catch (Exception $ex) {
            echo 'PUT request to example.com/comment failed';
        }

        return $content;
    }
}