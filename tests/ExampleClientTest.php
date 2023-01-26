<?php

namespace Kildsforkids\ExampleClientBundle\Tests;

use Kildsforkids\ExampleClientBundle\Service\ExampleClient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ExampleClientTest extends KernelTestCase
{
    public function testFetchComments()
    {
        self::bootKernel();
        $container = static::getContainer();
        $exampleClient = $container->get(ExampleClient::class);

        $dataPath = __DIR__.'/../data/example.json';
        $data = json_decode(file_get_contents($dataPath), true);

        $this->assertEquals($data, $exampleClient->fetchComments());
    }

    public function testAddComment()
    {
        self::bootKernel();
        $container = static::getContainer();
        $exampleClient = $container->get(ExampleClient::class);

        $this->assertEquals([
            'id' => 1,
            'name' => 'Андрей',
            'text' => 'Первый'
        ], $exampleClient->addComment('Андрей', 'Первый'));
    }

    public function testUpdateComment()
    {
        self::bootKernel();
        $container = static::getContainer();
        $exampleClient = $container->get(ExampleClient::class);

        $this->assertEquals([
            'id' => 1,
            'name' => 'Анатолий',
        ], $exampleClient->updateComment(1, [
            'name' => 'Анатолий'
        ]));
    }
}