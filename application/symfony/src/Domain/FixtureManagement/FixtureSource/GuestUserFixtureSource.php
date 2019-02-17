<?php

namespace Infinito\Domain\FixtureManagement\FixtureSource;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Complex\UserSource;

/**
 * This class containes the guest user.
 *
 * @author kevinfrantz
 */
final class GuestUserFixtureSource extends AbstractFixtureSource
{
    const SLUG = 'GUEST_USER';

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $userSource = new UserSource();
        $userSource->setSlug(self::SLUG);

        return $userSource;
    }

    /**
     * @return string
     */
    public static function getSlug(): string
    {
        return self::SLUG;
    }
}
