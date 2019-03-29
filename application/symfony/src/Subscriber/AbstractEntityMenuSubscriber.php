<?php

namespace Infinito\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Translation\TranslatorInterface;
use Infinito\DBAL\Types\RESTResponseType;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParameterBag;

/**
 * This class is just a result of refactoring. Feel free to replace it.
 *
 * @author kevinfrantz
 */
abstract class AbstractEntityMenuSubscriber implements EventSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param ItemInterface $menu
     * @param Event         $event
     * @param string        $route
     */
    protected function generateShowDropdown(ItemInterface $menu, Event $event, string $route): void
    {
        $dropdown = $menu->addChild($this->trans('format'), [
            'attributes' => [
                'icon' => 'fas fa-file',
                'dropdown' => 'true',
            ],
        ]);
        foreach (RESTResponseType::getValues() as $format) {
            $dropdown->addChild($format, [
                'route' => $route,
                'routeParameters' => $this->getRequestAttributsSubstitutedFormat($event, $format),
                'attributes' => [
                    'icon' => 'fas fa-sign-out-alt',
                    'divider_append' => true,
                ],
            ]);
        }
        $dropdown->addChild($this->trans('standard'), [
            'route' => $route,
            'routeParameters' => $this->getRequestAttributs($event),
            'attributes' => [
                'icon' => 'fas fa-sign-out-alt',
            ],
        ]);
    }

    /**
     * @param string $id
     * @param array  $parameter
     *
     * @return string
     */
    protected function trans(string $id, array $parameter = []): string
    {
        return $this->translator->trans($id, $parameter);
    }

    /**
     * @param Event $event
     *
     * @return Request
     */
    private function getCurrentRequest(Event $event): Request
    {
        return $event->getRequest()->getCurrentRequest();
    }

    /**
     * @param Event $event
     *
     * @return ParameterBag
     */
    private function getRequestAttributs(Event $event): array
    {
        return $this->getCurrentRequest($event)->attributes->get('_route_params') ?? [];
    }

    /**
     * @param Event  $event
     * @param string $format
     *
     * @return number|string
     */
    private function getRequestAttributsSubstitutedFormat(Event $event, string $format): array
    {
        $attributs = $this->getRequestAttributs($event);
        $attributs['_format'] = $format;

        return $attributs;
    }

    /**
     * @param Event $event
     *
     * @return bool
     */
    protected function shouldShowFormatSelection(Event $event): bool
    {
        foreach (['identity', 'layer'] as $attribut) {
            if (!key_exists($attribut, $this->getRequestAttributs($event))) {
                return false;
            }
        }

        return true;
    }
}
