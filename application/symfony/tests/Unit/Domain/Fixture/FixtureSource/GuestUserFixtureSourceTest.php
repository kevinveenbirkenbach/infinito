<?php

namespace tests\Unit\Domain\Fixture;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Fixture\FixtureSource\GuestUserFixtureSource;

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
