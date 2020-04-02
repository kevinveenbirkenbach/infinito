<?php

namespace Infinito\Subscriber;

use FOS\RestBundle\Request\ParameterBag;
use Infinito\Controller\AbstractController;
use Infinito\DBAL\Types\RESTResponseType;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

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

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

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

    protected function trans(string $id, array $parameter = []): string
    {
        return $this->translator->trans($id, $parameter);
    }

    private function getCurrentRequest(Event $event): Request
    {
        return $event->getRequest()->getCurrentRequest();
    }

    /**
     * @return ParameterBag
     */
    protected function getRequestAttributs(Event $event): array
    {
        return $this->getCurrentRequest($event)->attributes->get('_route_params') ?? [];
    }

    /**
     * @return number|string
     */
    private function getRequestAttributsSubstitutedFormat(Event $event, string $format): array
    {
        $attributs = $this->getRequestAttributs($event);
        $attributs[AbstractController::FORMAT_PARAMETER_KEY] = $format;

        return $attributs;
    }
}
