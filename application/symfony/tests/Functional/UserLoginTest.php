<?php

namespace Tests\Functional;

use Infinito\DataFixtures\DummyFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Tests if test user can login.
 *
 * @author Kevin Veen-Birkenbach [aka. Frantz]
 */
class UserLoginTest extends WebTestCase
{
    /**
     * @var Crawler
     */
    private $crawler;

    private $client;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->client = $this->createClient();
        $this->crawler = $this->client->request('GET', '/login');
    }

    public function testIfLoginFormPageIsReachable(): void
    {
        $this->assertEquals(200, $this->client->getResponse()
            ->getStatusCode());
    }

    /**
     * @todo Implemnt test for success message
     */
    public function testSuccessfullLogin(): void
    {
        $this->client->followRedirects();
        $form = $this->crawler->selectButton('Log in')->form();
        $form['_username']->setValue(DummyFixtures::USER_NAME);
        $form['_password']->setValue(DummyFixtures::USER_PASSWORD);
        $form['_remember_me']->setValue('on');
        $this->client->submit($form);
        $this->assertContains(
            'edit profile',
            $this->client->getResponse()->getContent()
            );
        $this->assertContains(
            'logout',
            $this->client->getResponse()->getContent()
            );
        $this->assertContains(
            'user source',
            $this->client->getResponse()->getContent()
            );
        $this->assertContains(
            DummyFixtures::USER_NAME,
            $this->client->getResponse()->getContent()
            );
    }

    public function testWrongPassword(): void
    {
        $this->client->followRedirects();
        $form = $this->crawler->selectButton('Log in')->form();
        $form['_username']->setValue(DummyFixtures::USER_NAME);
        $form['_password']->setValue('wrong password');
        $form['_remember_me']->setValue('on');
        $this->client->submit($form);
        $this->assertContains(
        'Invalid credentials.',
        $this->client->getResponse()->getContent()
        );
    }

    public function testWrongUsername(): void
    {
        $this->client->followRedirects();
        $form = $this->crawler->selectButton('Log in')->form();
        $form['_username']->setValue('unknown_username');
        $form['_password']->setValue(DummyFixtures::USER_PASSWORD);
        $form['_remember_me']->setValue('on');
        $this->client->submit($form);
        $this->assertContains(
        'Username could not be found.',
        $this->client->getResponse()->getContent()
        );
    }
}
