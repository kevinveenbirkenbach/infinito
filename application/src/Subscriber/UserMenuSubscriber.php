<?php
// src/Subscriber/UserMenuSubscriber.php

namespace App\Subscriber;

use App\Entity\User;
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
    
    public function onUserMenuConfigure(UserMenuEvent $event)
    {
        $menu = $event->getItem();
        /** @var User $user */
        $user = $this->tokenStorage->getToken()->getUser();
 
        $dropdown = $menu->addChild(
            $this->translator->trans('Hello %username%', ['%username%' => 'Noname'], 'usermenu'),
            ['dropdown' => true]
            );
        
        $dropdown->addChild(
            $this->translator->trans('Login', [], 'usermenu'),
            ['route' => 'user_login']
            );
    }
    
    public static function getSubscribedEvents(): array
    {
        return [
            UserMenuEvent::EVENT => 'onUserMenuConfigure',
        ];
    }
}