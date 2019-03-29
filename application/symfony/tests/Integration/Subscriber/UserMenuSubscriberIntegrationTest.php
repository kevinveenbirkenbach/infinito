<?php

namespace Tests\Integration\Entity\Subscriber;

use Symfony\Component\Translation\Translator;
use Infinito\Event\Menu\MenuEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Knp\Menu\MenuItem;
use Knp\Menu\MenuFactory;
use Infinito\Subscriber\UserMenuSubscriber;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @author kevinfrantz
 */
class UserMenuSubscriberIntegrationTest extends KernelTestCase
{
    /**
     * @var UserMenuSubscriber
     */
    private $subscriber;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorge;

    public function setUp(): void
    {
        self::bootKernel();
        $translator = new Translator('en');
        $this->tokenStorage = self::$container->get(TokenStorageInterface::class);
        $this->subscriber = new UserMenuSubscriber($this->tokenStorage, $translator);
    }

    public function testOnUserMenuConfigure(): void
    {
        $factory = new MenuFactory();
        $item = new MenuItem('test', $factory);
        $request = new Request();
        $requests = new RequestStack();
        $requests->push($request);
        $event = new MenuEvent($factory, $item, $requests);
        $this->assertNull($this->subscriber->onUserMenuConfigure($event));
    }

    public function testAuthentificatedUserFields(): void
    {
        $token = $this->createMock(TokenInterface::class);
        $token->method('getRoles')->willReturn([new Role('test_role')]);
        $token->method('getUsername')->willReturn('test_user');
        $this->tokenStorage->setToken($token);
        $factory = new MenuFactory();
        $item = new MenuItem('test', $factory);
        $request = new Request();
        $requests = new RequestStack();
        $requests->push($request);
        $menuEvent = new MenuEvent($factory, $item, $requests);
        $this->subscriber->onUserMenuConfigure($menuEvent);
        $children = $menuEvent->getItem()->getChildren()['test_user']->getChildren();
        $authentificatedItems = ['logout', 'edit profile'];
        foreach ($authentificatedItems as $key) {
            $this->assertInstanceOf(MenuItem::class, $children[$key]);
        }
        $this->assertEquals(count($children), count($authentificatedItems));
    }

    public function testUnauthentificatedUserFields(): void
    {
        $factory = new MenuFactory();
        $item = new MenuItem('test', $factory);
        $request = new Request();
        $requests = new RequestStack();
        $requests->push($request);
        $menuEvent = new MenuEvent($factory, $item, $requests);
        $this->subscriber->onUserMenuConfigure($menuEvent);
        $children = $menuEvent->getItem()->getChildren()['user']->getChildren();
        $unauthentificatedItems = ['login', 'register'];
        foreach ($unauthentificatedItems as $key) {
            $this->assertInstanceOf(MenuItem::class, $children[$key]);
        }
        $this->assertEquals(count($children), count($unauthentificatedItems));
    }
}
