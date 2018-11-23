<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Containes the system slugs.
 *
 * @author kevinfrantz
 */
final class SystemSlugType extends AbstractEnumType
{
    public const IMPRINT = 'IMPRINT';

    protected static $choices = [
        self::IMPRINT => 'imprint',
    ];
}
