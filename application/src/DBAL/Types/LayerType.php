<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * @author kevinfrantz
 */
final class LayerType extends AbstractEnumType
{
    public const RELATION = 'relation';

    public const SOURCE = 'source';

    public const LAW = 'law';

    protected static $choices = [
        self::RELATION => 'relation',
        self::LAW => 'law',
        self::SOURCE => 'source',
    ];
}
