<?php

namespace Tests\Unit\Entity\Subscriber;

use Symfony\Component\Translation\Translator;
use Infinito\Event\Menu\MenuEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Knp\Menu\MenuItem;
use Knp\Menu\MenuFactory;
use Infinito\Subscriber\UserMenuSubscriber;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @author kevinfrantz
 */
class UserMenuSubscriberTest extends KernelTestCase
{
    /**
     * @var UserMenuSubscriber
     */
    public $subscriber;

    public function setUp(): void
    {
        self::bootKernel();
        $translator = new Translator('en');
        $tokenStorage = self::$container->get(TokenStorageInterface::class);
        $this->subscriber = new UserMenuSubscriber($tokenStorage, $translator);
    }

    public function testOnUserMenuConfigure(): void
    {
        $factory = new MenuFactory();
        $item = new MenuItem('test', $factory);
        $request = new Request();
        $request->attributes->set('id', 123);
        $requests = new RequestStack();
        $requests->push($request);
        $event = new MenuEvent($factory, $item, $requests);
        $this->assertNull($this->subscriber->onUserMenuConfigure($event));
    }
}
