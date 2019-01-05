<?php

namespace Tests\Unit\Entity\Subscriber;

use App\Subscriber\SourceMenuSubscriber;
use Symfony\Component\Translation\Translator;
use App\Event\Menu\MenuEvent;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Knp\Menu\MenuItem;
use Knp\Menu\MenuFactory;

class SourceMenuSubscriberTest extends TestCase
{
    /**
     * @var SourceMenuSubscriber
     */
    public $subscriber;

    public function setUp(): void
    {
        $translator = new Translator('en');
        $this->subscriber = new SourceMenuSubscriber($translator);
    }

    public function testOnSourceMenuConfig(): void
    {
        $factory = new MenuFactory();
        $item = new MenuItem('test', $factory);
        $request = new Request();
        $request->attributes->set('id', 123);
        $requests = new RequestStack();
        $requests->push($request);
        $event = new MenuEvent($factory, $item, $requests);
        $this->assertNull($this->subscriber->onSourceMenuConfigure($event));
    }
}
