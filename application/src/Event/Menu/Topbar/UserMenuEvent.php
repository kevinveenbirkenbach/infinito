<?php

namespace App\Event\Menu\Topbar;

use App\Event\Menu\AbstractMenuEvent;

class UserMenuEvent extends AbstractMenuEvent
{
    public const EVENT = 'app.menu.topbar.user';
}