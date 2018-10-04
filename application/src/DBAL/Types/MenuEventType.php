<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Not integrated in the db. Just used for mapping. 
 * May it will be helpfull for tracking ;)
 * @author kevinfrantz
 */
final class MenuEventType extends AbstractEnumType
{   
    public const USER = 'app.menu.topbar.user';
    
    public const SOURCE = 'app.menu.source.user';

    protected static $choices = [
        self::USER => self::USER,
        self::SOURCE => self::SOURCE,
    ];
}
