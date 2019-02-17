<?php

namespace tests\Integration\Domain\FixtureManagement;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\FixtureManagement\FixtureSourceFactory;
use Infinito\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface;
use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
class FixtureSourceFactoryTest extends TestCase
{
    /**
     * @var array|FixtureSourceInterface[]
     */
    protected $fixtureSources;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->fixtureSources = FixtureSourceFactory::getAllFixtureSources();
    }

    public function testFixtureSourcesSlugs(): void
    {
        $slugs = [];
        foreach ($this->fixtureSources as $fixtureSource) {
            $this->assertInstanceOf(FixtureSourceInterface::class, $fixtureSource);
            $slug = $fixtureSource->getSlug();
            $this->assertIsString($slug);
            $this->assertFalse(in_array($slug, $slugs), 'A slug has to be unique');
            $slugs[] = $slug;
        }
    }

    public function testFixtureSourcesObjects(): void
    {
        $objects = [];
        foreach ($this->fixtureSources as $fixtureSource) {
            $this->assertInstanceOf(SourceInterface::class, $fixtureSource->getORMReadyObject());
            $this->assertFalse(in_array($fixtureSource, $objects), 'A slug has to be unique');
            $objects[] = $fixtureSource;
        }
    }
}
