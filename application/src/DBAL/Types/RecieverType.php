<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * @author kevinfrantz
 */
final class RecieverType extends AbstractEnumType
{
    public const NODE = 'node';

    public const PARENTS = 'parents';

    public const CHILDREN = 'children';

    public const SIBLINGS = 'siblings';

    protected static $choices = [
        self::NODE => 'node',
        self::PARENTS => 'parents',
        self::CHILDREN => 'children',
        self::SIBLINGS => 'siblings',
    ];
}
