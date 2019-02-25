<?php

namespace Infinito\DBAL\Types\Meta\Right;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * @author kevinfrantz
 *
 * @todo Implement more layers and refactor!
 */
final class LayerType extends AbstractEnumType
{
    public const HEREDITY = 'heredity';

    public const RIGHT = 'right';

    public const SOURCE = 'source';

    public const LAW = 'law';

    public const MEMBER = 'member';

    const CREATOR = 'creator';

    /**
     * @var array Ordered by the importants of implementation
     */
    protected static $choices = [
        self::SOURCE => 'source',
        self::LAW => 'law',
        self::RIGHT => 'right',
        self::MEMBER => 'member relation',
        self::HEREDITY => 'heredity relation',
        self::CREATOR => 'creator relation',
    ];
}
