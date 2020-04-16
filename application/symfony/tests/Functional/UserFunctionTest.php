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
class UserFunctionTest extends WebTestCase
{
    /**
     * 
     * @var string
     */
    private $username = '';
    
    /**
     * 
     * @var string
     */
    private $password = '';
    
    /**
     * 
     * @var string
     */
    private $email = '';
    
    /**
     * @var Crawler
     */
    private $crawler;

    private $client;

    private function initAttributs():void{
        $this->username = 'function_test_user';
        $this->password = 'function_test_user_password';
        $this->email = 'function_test_user@test.test';
    }
    
    private function crawlUrl(string $url):void{
        $this->crawler = $this->client->request('GET', $url);
        $this->client->followRedirects();
    }
    
    private function registerUser():void{
        $this->crawlUrl('/register/');
        $form = $this->crawler->selectButton('Register')->form();
        $form['fos_user_registration_form[username]']->setValue($this->username);
        $form['fos_user_registration_form[email]']->setValue($this->email);
        $form['fos_user_registration_form[plainPassword][first]']->setValue($this->password);
        $form['fos_user_registration_form[plainPassword][second]']->setValue($this->password);
        $this->client->submit($form);
    }
    
    
    
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->client = $this->createClient();
        $this->initAttributs();
        $this->registerUser();
    }
    
    public function testIfLoginFormPageIsReachable(): void
    {
        $this->assertEquals(200, $this->client->getResponse()
            ->getStatusCode());
    }

    public function testLoginSuccessfull(): void
    {
        $this->crawlUrl('/login/');
        $form = $this->crawler->selectButton('Log in')->form();
        $form['_username']->setValue($this->username);
        $form['_password']->setValue($this->password);
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
            $this->username,
            $this->client->getResponse()->getContent()
            );
    }

    public function testLoginWrongPassword(): void
    {
        $this->crawlUrl('/login/');
        $form = $this->crawler->selectButton('Log in')->form();
        $form['_username']->setValue($this->username);
        $form['_password']->setValue('wrong password');
        $form['_remember_me']->setValue('on');
        $this->client->submit($form);
        $this->assertContains(
        'Invalid credentials.',
        $this->client->getResponse()->getContent()
        );
    }

    public function testLoginWrongUsername(): void
    {
        $this->crawlUrl('/login/');
        $form = $this->crawler->selectButton('Log in')->form();
        $form['_username']->setValue('unknown_username');
        $form['_password']->setValue($this->password);
        $form['_remember_me']->setValue('on');
        $this->client->submit($form);
        $this->assertContains(
        'Username could not be found.',
        $this->client->getResponse()->getContent()
        );
    }
}
