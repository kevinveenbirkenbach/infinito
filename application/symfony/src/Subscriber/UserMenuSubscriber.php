<?php

namespace Infinito\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Knp\Menu\ItemInterface;
use Infinito\Event\Menu\MenuEvent;
use Infinito\DBAL\Types\MenuEventType;
use Infinito\Domain\FixtureManagement\FixtureSource\ImpressumFixtureSource;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * @author kevinfrantz
 */
class UserMenuSubscriber extends AbstractEntityMenuSubscriber implements EventSubscriberInterface
{
    /**
     * @var string
     */
    const LAYER_GET_ROUTE = 'infinito_api_rest_layer_read';

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface $tokenStorage
     * @param TranslatorInterface   $translator
     */
    public function __construct(TokenStorageInterface $tokenStorage, TranslatorInterface $translator)
    {
        $this->tokenStorage = $tokenStorage;
        parent::__construct($translator);
    }

    /**
     * @param MenuEvent $event
     */
    public function onUserMenuConfigure(MenuEvent $event): void
    {
        $menu = $event->getItem();
        $menu->addChild($this->trans('start'), [
            'route' => 'homepage',
            'attributes' => [
                'icon' => 'fab fa-font-awesome-flag',
            ],
        ]);

        $menu->addChild($this->trans('imprint'), [
            'uri' => '/api/rest/source/'.strtolower(ImpressumFixtureSource::SLUG).'.html',
            'attributes' => [
                'icon' => 'fas fa-address-card',
            ],
        ]);
        if ($this->shouldShowFormatSelection($event)) {
            $this->generateShowDropdown($menu, $event, self::LAYER_GET_ROUTE);
        }
        $this->generateUserDropdown($menu);
    }

    /**
     * @return TokenInterface|null
     */
    private function getToken(): ?TokenInterface
    {
        return $this->tokenStorage->getToken();
    }

    /**
     * @return string
     */
    private function getUsername(): string
    {
        $token = $this->getToken();

        return ($token) ? $token->getUsername() : $this->trans('user');
    }

    /**
     * @return array|null
     */
    private function getRoles(): ?array
    {
        $token = $this->getToken();

        return ($token) ? $token->getRoles() : null;
    }

    /**
     * @param ItemInterface $menu
     */
    private function generateUserDropdown(ItemInterface $menu): void
    {
        $dropdown = $menu->addChild($this->getUsername(), [
            'attributes' => [
                'dropdown' => true,
                'icon' => 'fas fa-user',
            ],
        ]);
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
                ],
            ]);
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            MenuEventType::USER => 'onUserMenuConfigure',
        ];
    }
}
