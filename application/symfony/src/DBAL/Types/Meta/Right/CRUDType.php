<?php

namespace App\DBAL\Types\Meta\Right;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * @author kevinfrantz
 */
class CRUDType extends AbstractEnumType
{
    public const CREATE = 'create';

    public const READ = 'read';

    public const UPDATE = 'update';

    public const DELETE = 'delete';

    protected static $choices = [
        self::CREATE => 'create',
        self::READ => 'read',
        self::UPDATE => 'update',
        self::DELETE => 'delete',
    ];
}
