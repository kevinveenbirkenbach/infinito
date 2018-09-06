<?php
namespace App\Subscriber;
use App\Event\Menu\Topbar\UserMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Translation\TranslatorInterface;

class UserMenuSubscriber implements EventSubscriberInterface
{

    /**
     *
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     *
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
        $menu->addChild(
            'linking',
            [
                'route' => 'homepage',
            ]
            );

        $menu->addChild(
            'texting',
            [
                'labelAttributes' => [
                    'class' => 'class3 class4',
                ],
            ]
            );

        $dropdown = $menu->addChild(
            'Hello Me',
            [
                'attributes' => [
                    'dropdown' => true,
                ],
            ]
            );

        $dropdown->addChild(
            'Profile',
            [
                'route' => 'homepage',
                'attributes' => [
                    'divider_append' => true,
                ],
            ]
            );

        $dropdown->addChild(
            'text',
            [
                'attributes' => [
                    'icon' => 'fa fa-user-circle',
                ],
                'labelAttributes' => [
                    'class' => ['class1', 'class2'],
                ],
            ]
            );

        $dropdown->addChild(
            'Logout',
            [
                'route' => 'user_logout',
                'attributes' => [
                    'divider_prepend' => true,
                    'icon' => 'fa fa-sign-out',
                ],
            ]
            );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            UserMenuEvent::EVENT => 'onUserMenuConfigure'
        ];
    }
}
