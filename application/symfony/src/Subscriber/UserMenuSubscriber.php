<?php

namespace Infinito\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Knp\Menu\ItemInterface;
use Infinito\Event\Menu\MenuEvent;
use Infinito\DBAL\Types\MenuEventType;
use Infinito\Domain\FixtureManagement\FixtureSource\ImpressumFixtureSource;

class UserMenuSubscriber implements EventSubscriberInterface
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

    /**
     * @param MenuEvent $event
     */
    public function onUserMenuConfigure(MenuEvent $event): void
    {
        $menu = $event->getItem();
        $menu->addChild($this->translator->trans('start'), [
            'route' => 'homepage',
            'attributes' => [
                'icon' => 'fab fa-font-awesome-flag',
            ],
        ]);

        $menu->addChild($this->translator->trans('imprint'), [
            'uri' => 'rest/api/source/'.strtolower(ImpressumFixtureSource::SLUG).'.html',
            'attributes' => [
                'icon' => 'fas fa-address-card',
            ],
        ]);
        $this->generateUserDropdown($menu);
    }

    private function generateUserDropdown(ItemInterface $menu): void
    {
        $dropdown = $menu->addChild($this->tokenStorage->getToken()
            ->getUsername() ?? 'user', [
            'attributes' => [
                'dropdown' => true,
                'icon' => 'fas fa-user',
            ],
        ]);
        if ($this->tokenStorage->getToken()->getRoles()) {
            $dropdown->addChild($this->translator->trans('logout'), [
                'route' => 'logout',
                'attributes' => [
                    'icon' => 'fas fa-sign-out-alt',
                    'divider_append' => true,
                ],
            ]);
            $dropdown->addChild($this->translator->trans('edit profile'), [
                'route' => 'fos_user_profile_edit',
                'attributes' => [
                    'icon' => 'fas fa-user-edit',
                    'divider_append' => true,
                ],
            ]);
        } else {
            $dropdown->addChild($this->translator->trans('login'), [
                'route' => 'fos_user_security_login',
                'attributes' => [
                    'divider_append' => true,
                    'icon' => 'fas fa-sign-in-alt',
                ],
            ]);
        }
        $dropdown->addChild('register', [
            'route' => 'fos_user_registration_register',
            'attributes' => [
                'icon' => 'fas fa-file-signature',
            ],
        ]);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            MenuEventType::USER => 'onUserMenuConfigure',
        ];
    }
}
