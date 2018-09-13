<?php

namespace App\Subscriber;

use App\Event\Menu\Topbar\UserMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Translation\TranslatorInterface;

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

    public function onUserMenuConfigure(UserMenuEvent $event): void
    {
        $menu = $event->getItem();
        $menu->addChild('start', [
            'route' => 'homepage',
            'attributes' => [
                'icon' => 'fab fa-font-awesome-flag',
            ],
          ]
        );

        $menu->addChild(
            'imprint',
            [
                'route' => 'imprint',
                'attributes' => [
                    'icon' => 'fas fa-address-card',
                ],
            ]
        );

        $dropdown = $menu->addChild($this->tokenStorage->getToken()
            ->getUsername() ?? 'user', [
            'attributes' => [
                'dropdown' => true,
                'icon' => 'fas fa-user',
            ],
        ]);
        if ($this->tokenStorage->getToken()->getRoles()) {
            $dropdown->addChild('logout', [
                'route' => 'logout',
                'attributes' => [
                    'icon' => 'fas fa-sign-out-alt',
                    'divider_append' => true,
                ],
            ]);
            $dropdown->addChild('edit profile', [
                'route' => 'fos_user_profile_edit',
                'attributes' => [
                    'icon' => 'fas fa-user-edit',
                    'divider_append' => true,
                ],
            ]);
        } else {
            $dropdown->addChild('login', [
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
            UserMenuEvent::EVENT => 'onUserMenuConfigure',
        ];
    }
}
