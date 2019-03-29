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
    /**
     * @var string
     */
    public const HEREDITY = 'heredity';

    /**
     * @var string
     */
    public const RIGHT = 'right';

    /**
     * @var string
     */
    public const SOURCE = 'source';

    /**
     * @var string
     */
    public const LAW = 'law';

    /**
     * @var string
     */
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
