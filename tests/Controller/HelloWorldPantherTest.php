<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

class HelloWorldPantherTest extends PantherTestCase
{
    public function testItSaysHelloWorld()
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/');

//        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
