<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * @author kevinfrantz
 */
final class RightType extends AbstractEnumType
{
    public const READ = 'read';

    public const WRITE = 'write';

    protected static $choices = [
        self::READ => 'read',
        self::WRITE => 'write',
    ];
}
