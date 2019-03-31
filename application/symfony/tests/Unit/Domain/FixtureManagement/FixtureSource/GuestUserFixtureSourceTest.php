<?php

namespace tests\Unit\Domain\FixtureManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\FixtureManagement\FixtureSource\GuestUserFixtureSource;

/**
 * @author kevinfrantz
 */
class GuestUserFixtureSourceTest extends TestCase
{
    public function testSlugName(): void
    {
        $fixtureSource = new GuestUserFixtureSource();
        $this->assertNotEquals($fixtureSource->getName(), $fixtureSource::getSlug());
    }
}
