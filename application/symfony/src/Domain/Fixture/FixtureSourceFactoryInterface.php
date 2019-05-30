<?php

namespace Infinito\Domain\Fixture;

use Infinito\Domain\Fixture\FixtureSource\FixtureSourceInterface;

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
