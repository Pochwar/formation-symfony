<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HelloWorldTest extends WebTestCase
{
    public function testItSaysHelloWorld()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        // this test will fail because we use JS to display hello world
        // instead we use Panther
        // $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
