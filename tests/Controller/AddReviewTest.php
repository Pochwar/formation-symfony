<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

class AddReviewTest extends PantherTestCase
{
    public function testItCanAddReviews()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/reviews/add');

        $this->assertResponseIsSuccessful();

        $addReviewForm = $crawler->filter('form[action$="/reviews/add"]');
        $this->assertCount(1, $addReviewForm);
    }
}
