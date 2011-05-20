<?php
use Silex\WebTestCase;

class MameFormTest extends WebTestCase
{
	public function createApplication()
	{
	    return require __DIR__.'/../mameform.php';
	}
	public function testInitialPage()
	{
	    $client = $this->createClient();
	    $crawler = $client->request('GET', '/');

	    $this->assertTrue($client->getResponse()->isOk());
	    $this->assertEquals(1, count($crawler->filter('h1:contains("Contact Form")')));
	    $this->assertEquals(1, count($crawler->filter('form')));
	}
}
