<?php

namespace Infinito\Domain\FixtureManagement\FixtureSource;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Attribut\SlugAttributInterface;

/**
 * This interface allows to save the configuration values of an fixture in a class.
 *
 * @author kevinfrantz
 */
interface FixtureSourceInterface
{
    /**
     * @return SourceInterface An source, which can be handled by Doctrine ORM persist
     */
    public function getORMReadyObject(): SourceInterface;

    /**
     * It's necessary for tests and to address the object correct.
     *
     * @return SlugAttributInterface
     */
    public static function getSlug(): string;
}
