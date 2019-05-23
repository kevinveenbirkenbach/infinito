<?php

namespace Infinito\Domain\MethodManagement;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Contains the possible prefixes for Methods.
 *
 * @author kevinfrantz
 */
final class MethodPrefixType extends AbstractEnumType
{
    /**
     * @var string Prefix for setter functions
     */
    public const SET = 'set';

    /**
     * @var string Prefix for getter functions
     */
    public const GET = 'get';

    /**
     * @var string Prefix for has functions
     */
    public const HAS = 'has';

    protected static $choices = [
        self::GET,
        self::HAS,
        self::SET,
    ];
}
