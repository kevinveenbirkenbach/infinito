<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Not integrated in the db. Just used for mapping.
 * May it will be helpfull for tracking ;).
 *
 * @author kevinfrantz
 */
final class MenuEventType extends AbstractEnumType
{
    public const USER = 'app.menu.topbar.user';

    public const SOURCE = 'app.menu.subbar.source';

    public const NODE = 'app.menu.subbar.node';

    /**
     * May this will be used in the future.
     *
     * @var array
     */
    protected static $choices = [];
}
