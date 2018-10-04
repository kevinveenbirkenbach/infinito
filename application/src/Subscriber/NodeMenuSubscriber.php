<?php
namespace App\Subscriber;

use App\DBAL\Types\MenuEventType;

/**
 *
 * @author kevinfrantz
 *        
 */
class NodeMenuSubscriber extends AbstractEntityMenuSubscriber
{
    public static function getSubscribedEvents()
    {
        return [
            MenuEventType::NODE => 'onNodeMenuConfigure'
        ];
    }
}

