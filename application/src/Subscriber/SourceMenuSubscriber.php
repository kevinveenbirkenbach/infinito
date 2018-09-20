<?php

namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Translation\TranslatorInterface;
use App\Event\Menu\Topbar\SourceMenuEvent;

class SourceMenuSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TokenStorageInterface $tokenStorage, TranslatorInterface $translator)
    {
        $this->tokenStorage = $tokenStorage;
        $this->translator = $translator;
    }

    public function onSourceMenuConfigure(SourceMenuEvent $event): void
    {
        $menu = $event->getItem();
        $menu->addChild($this->translator->trans('edit'), [
            'route' => 'app_source_edit',
            'routeParameters' => ['id' => $event->getRequest()->getCurrentRequest()->attributes->get('id')],
            'attributes' => [
                'icon' => 'fas fa-edit',
            ],
        ]);
        $menu->addChild($this->translator->trans('show'), [
            'route' => 'app_source_show',
            'routeParameters' => ['id' => $event->getRequest()->getCurrentRequest()->attributes->get('id')],
            'attributes' => [
                'icon' => 'fas fa-eye',
            ],
        ]);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            SourceMenuEvent::EVENT => 'onSourceMenuConfigure',
        ];
    }
}
