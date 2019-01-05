<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Containes the system slugs.
 *
 * @author kevinfrantz
 *
 * @todo Organize this somehow on an other way
 *
 * @deprecated
 */
final class SystemSlugType extends AbstractEnumType
{
    public const IMPRINT = 'IMPRINT';

    public const GUEST_USER = 'GUEST_USER';

    protected static $choices = [
        self::IMPRINT => 'imprint',
        self::GUEST_USER => 'guest user',
    ];
}
