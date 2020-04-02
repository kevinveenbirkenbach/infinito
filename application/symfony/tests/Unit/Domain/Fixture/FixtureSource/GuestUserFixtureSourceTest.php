<?php

namespace tests\Unit\Domain\Fixture;

use Infinito\Domain\Fixture\FixtureSource\GuestUserFixtureSource;
use PHPUnit\Framework\TestCase;

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
