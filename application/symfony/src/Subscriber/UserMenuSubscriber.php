<?php

namespace Infinito\Subscriber;

use Infinito\Controller\API\Rest\LayerController;
use Infinito\DBAL\Types\MenuEventType;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\DBAL\Types\RESTResponseType;
use Infinito\Domain\Fixture\FixtureSource\FixtureSourceInterface;
use Infinito\Domain\Fixture\FixtureSource\GuestUserFixtureSource;
use Infinito\Domain\Fixture\FixtureSource\HelpFixtureSource;
use Infinito\Domain\Fixture\FixtureSource\HomepageFixtureSource;
use Infinito\Domain\Fixture\FixtureSource\ImpressumFixtureSource;
use Infinito\Domain\Fixture\FixtureSource\InformationFixtureSource;
use Infinito\Domain\Fixture\FixtureSourceFactory;
use Infinito\Event\Menu\MenuEvent;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @author kevinfrantz
 *
 * @todo Refactor this class!
 */
class UserMenuSubscriber extends AbstractEntityMenuSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var FixtureSourceInterface[]
     */
    private $fixtureSources;

    public function __construct(TokenStorageInterface $tokenStorage, TranslatorInterface $translator)
    {
        $this->fixtureSources = FixtureSourceFactory::getAllFixtureSources();
        $this->tokenStorage = $tokenStorage;
        parent::__construct($translator);
    }

    private function deleteAndAddToItem(ItemInterface $item, string $slug): void
    {
        $fixtureSource = $this->getAndDeleteFixtureSource($slug);
        $this->addFixtureSourceToItem($item, $fixtureSource);
    }

    private function getAndDeleteFixtureSource(string $slug): FixtureSourceInterface
    {
        $result = clone $this->fixtureSources[$slug];
        unset($this->fixtureSources[$slug]);

        return $result;
    }

    public function onUserMenuConfigure(MenuEvent $event): void
    {
        $menu = $event->getItem();
        foreach ([HomepageFixtureSource::getSlug(), ImpressumFixtureSource::getSlug(), InformationFixtureSource::getSlug(), HelpFixtureSource::getSlug()] as $slug) {
            $this->deleteAndAddToItem($menu, $slug);
        }
        if ($this->shouldShowFormatSelection($event)) {
            $this->generateShowDropdown($menu, $event, LayerController::LAYER_GET_ROUTE);
        }
        $this->generateUserDropdown($menu);
        foreach ($this->fixtureSources as $fixtureSource) {
            $this->addFixtureSourceToItem($menu, $fixtureSource);
        }
    }

    private function addFixtureSourceToItem(ItemInterface $item, FixtureSourceInterface $fixtureSource): void
    {
        $slug = $fixtureSource::getSlug();
        $name = $fixtureSource->getName();
        $icon = $fixtureSource::getIcon();
        $item->addChild($this->trans($name), $this->getSourceItemConfigurationArray($slug, $icon));
    }

    /**
     * @return []
     */
    private function getSourceItemConfigurationArray(string $identity, string $icon)
    {
        return [
            'route' => LayerController::LAYER_GET_ROUTE,
            'routeParameters' => [
                LayerController::IDENTITY_PARAMETER_KEY => $identity,
                LayerController::FORMAT_PARAMETER_KEY => RESTResponseType::HTML,
                LayerController::LAYER_PARAMETER_KEY => LayerType::SOURCE,
            ],
            'attributes' => [
                'icon' => $icon,
            ],
        ];
    }

    private function getToken(): ?TokenInterface
    {
        return $this->tokenStorage->getToken();
    }

    private function getUsername(): string
    {
        $token = $this->getToken();

        return ($token) ? $token->getUsername() : $this->trans('user');
    }

    private function getRoles(): ?array
    {
        $token = $this->getToken();

        return ($token) ? $token->getRoles() : null;
    }

    private function generateUserDropdown(ItemInterface $menu): void
    {
        $dropdown = $menu->addChild($this->getUsername(), [
            'attributes' => [
                'dropdown' => true,
                'icon' => 'fas fa-user',
            ],
        ]);
        $guestUser = $this->getAndDeleteFixtureSource(GuestUserFixtureSource::getSlug());
        if ($this->getRoles()) {
            $dropdown->addChild($this->trans('logout'), [
                'route' => 'logout',
                'attributes' => [
                    'icon' => 'fas fa-sign-out-alt',
                    'divider_append' => true,
                ],
            ]);
            $dropdown->addChild($this->trans('edit profile'), [
                'route' => 'fos_user_profile_edit',
                'attributes' => [
                    'icon' => 'fas fa-user-edit',
                    'divider_append' => true,
                ],
            ]);
            $userSource = $this->getToken()->getUser()->getSource();
            $identity = $userSource->getId();
            $icon = 'fas fa-user';
            $dropdown->addChild($this->trans('user source'), $this->getSourceItemConfigurationArray($identity, $icon));
        } else {
            $dropdown->addChild($this->trans('login'), [
                'route' => 'fos_user_security_login',
                'attributes' => [
                    'divider_append' => true,
                    'icon' => 'fas fa-sign-in-alt',
                ],
            ]);
            $dropdown->addChild('register', [
                'route' => 'fos_user_registration_register',
                'attributes' => [
                    'icon' => 'fas fa-file-signature',
                    'divider_append' => true,
                ],
            ]);
            $this->addFixtureSourceToItem($dropdown, $guestUser);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            MenuEventType::USER => 'onUserMenuConfigure',
        ];
    }

    private function shouldShowFormatSelection(Event $event): bool
    {
        foreach ([
            LayerController::IDENTITY_PARAMETER_KEY,
            LayerController::LAYER_PARAMETER_KEY,
        ] as $key) {
            $attributs = $this->getRequestAttributs($event);
            if (!key_exists($key, $attributs) || '' === $attributs[$key]) {
                return false;
            }
        }

        return true;
    }
}
