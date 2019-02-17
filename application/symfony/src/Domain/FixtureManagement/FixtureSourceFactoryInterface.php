<?php

namespace Infinito\Domain\FixtureManagement;

use Infinito\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface;

/**
 * Offers a Factory to produce sources.
 *
 * @author kevinfrantz
 */
interface FixtureSourceFactoryInterface
{
    /**
     * @return array|FixtureSourceInterface[] Returns all existing fixture sources
     */
    public static function getAllFixtureSources(): array;
}
