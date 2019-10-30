<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

class AddReviewTest extends PantherTestCase
{
    public function testItCanAddReviews()
    {
        // test page exists and is reachable
        $client = static::createClient();
        $crawler = $client->request('GET', '/reviews/add');
        $this->assertResponseIsSuccessful();

        // test form exists
        $addReviewForm = $crawler->filter('form[action$="/reviews/add"]');
        $this->assertCount(1, $addReviewForm);

        // test succes message is not display by default
        $this->assertSelectorNotExists('div.success');

        // submit form
        $client->submit($addReviewForm->form(), [
            'review[content]' => 'some content'
        ]);


        // test success message is displayed after form submit
        /*
         * same as $client->getCrawler()->filter()
         * we use '$client->getCrawler' instead of '$crawler' because dom has changed
         *
         */
        $this->assertSelectorExists('div.success');

        // test input is empty after form submit
        $inputFieldReviewContent = $client->getCrawler()->filter('input[name="review[content]"]');
        $this->assertEmpty(
            $inputFieldReviewContent->attr('value'),
            'The content input is not empty'
        );

    }
}
