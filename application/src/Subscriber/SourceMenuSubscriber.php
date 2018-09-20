<?php

namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Translation\TranslatorInterface;
use App\Event\Menu\Topbar\SourceMenuEvent;
use Knp\Menu\ItemInterface;

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
            'routeParameters' => [
                'id' => $event->getRequest()->getCurrentRequest()->attributes->get('id'),
            ],
            'attributes' => [
                'icon' => 'fas fa-edit',
            ],
        ]);
        $this->generateSourceFormatDropdown($menu, $event);
    }

    private function generateSourceFormatDropdown(ItemInterface $menu, SourceMenuEvent $event): void
    {
        $dropdown = $menu->addChild($this->translator->trans('show'), [
            'attributes' => [
                'icon' => 'fas fa-eye',
                'dropdown' => 'true',
            ],
        ]);
        foreach ([
            'html',
            'json',
            'xml',
        ] as $format) {
            $dropdown->addChild($format, [
                'route' => 'app_source_show',
                'routeParameters' => [
                    'id' => $event->getRequest()->getCurrentRequest()->attributes->get('id'),
                    '_format' => $format,
                ],
                'attributes' => [
                    'icon' => 'fas fa-sign-out-alt',
                    'divider_append' => true,
                ],
            ]);
        }
        $dropdown->addChild($this->translator->trans('standard'), [
            'route' => 'app_source_show',
            'routeParameters' => [
                'id' => $event->getRequest()->getCurrentRequest()->attributes->get('id'),
            ],
            'attributes' => [
                'icon' => 'fas fa-sign-out-alt',
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
