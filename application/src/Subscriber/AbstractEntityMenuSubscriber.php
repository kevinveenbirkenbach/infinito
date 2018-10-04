<?php
namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Translation\TranslatorInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
abstract class AbstractEntityMenuSubscriber implements EventSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;
    
    const FORMAT_TYPES = [
        'html',
        'json',
        'xml'
    ];
    
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    protected function generateShowDropdown(ItemInterface $menu, Event $event,string $route): void
    {
        $dropdown = $menu->addChild($this->trans('show'), [
            'attributes' => [
                'icon' => 'fas fa-eye',
                'dropdown' => 'true'
            ]
        ]);
        foreach (self::FORMAT_TYPES as $format) {
            $dropdown->addChild($format, [
                'route' => $route,
                'routeParameters' => [
                    'id' => $this->getRequestId($event),
                    '_format' => $format
                ],
                'attributes' => [
                    'icon' => 'fas fa-sign-out-alt',
                    'divider_append' => true
                ]
            ]);
        }
        $dropdown->addChild($this->trans('standard'), [
            'route' => $route,
            'routeParameters' => [
                'id' => $this->getRequestId($event)
            ],
            'attributes' => [
                'icon' => 'fas fa-sign-out-alt'
            ]
        ]);
    }
    
    protected function trans(string $id, array $parameter=[]):string{
        return $this->translator->trans($id,$parameter);
    }

    protected function getRequestId(Event $event): int
    {
        return $event->getRequest()->getCurrentRequest()->attributes->get('id');
    }
}

