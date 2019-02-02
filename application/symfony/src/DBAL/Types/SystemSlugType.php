<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;
use App\Domain\FixtureManagement\FixtureSource\ImpressumFixtureSource;
use App\Domain\FixtureManagement\FixtureSource\GuestUserFixtureSource;

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
    /**
     * @deprecated
     * @see ImpressumFixtureSource
     */
    public const IMPRINT = 'IMPRINT';

    /**
     * @deprecated
     * @see GuestUserFixtureSource
     */
    public const GUEST_USER = 'GUEST_USER';

    /**
     * @deprecated
     *
     * @var array
     */
    protected static $choices = [
        self::IMPRINT => 'imprint',
        self::GUEST_USER => 'guest user',
    ];
}
