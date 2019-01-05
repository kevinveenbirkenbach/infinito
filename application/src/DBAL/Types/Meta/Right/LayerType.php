<?php

namespace App\DBAL\Types\Meta\Right;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * @author kevinfrantz
 */
final class LayerType extends AbstractEnumType
{
    public const RELATION = 'relation';

    public const SOURCE = 'source';

    public const LAW = 'law';

    public const MEMBER = 'member';

    protected static $choices = [
        self::RELATION => 'relation',
        self::LAW => 'law',
        self::SOURCE => 'source',
    ];
}
