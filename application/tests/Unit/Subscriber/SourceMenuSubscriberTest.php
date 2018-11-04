<?php
namespace Tests\Unit\Entity\Subscriber;

use App\Subscriber\SourceMenuSubscriber;
use App\Subscriber\UserMenuSubscriber;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Translation\Translator;
use App\Event\Menu\MenuEvent;
use PHPUnit\Framework\TestCase;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class SourceMenuSubscriberTest extends TestCase
{

    /**
     *
     * @var SourceMenuSubscriber
     */
    public $subscriber;

    public function setUp(): void
    {
        $translator = new Translator('en');
        $this->subscriber = new SourceMenuSubscriber($translator);
    }
    
    public function testOnSourceMenuConfig():void{
        $factory = $this->createMock(FactoryInterface::class);
        $item = $this->createMock(ItemInterface::class);
        $request = $this->createMock(RequestStack::class);
        $event = new MenuEvent($factory, $item, $request);
        $this->assertNull($this->subscriber->onSourceMenuConfigure($event));
    }
}



