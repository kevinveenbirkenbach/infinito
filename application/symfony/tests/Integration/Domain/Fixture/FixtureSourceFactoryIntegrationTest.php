<?php

namespace tests\Integration\Domain\Fixture;

use Infinito\Domain\Fixture\FixtureSource\FixtureSourceInterface;
use Infinito\Domain\Fixture\FixtureSourceFactory;
use Infinito\Entity\Source\SourceInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 */
class FixtureSourceFactoryIntegrationTest extends TestCase
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

    public function testFixtureSourcesIcons(): void
    {
        $icons = [];
        foreach ($this->fixtureSources as $fixtureSource) {
            $this->assertInstanceOf(FixtureSourceInterface::class, $fixtureSource);
            $icon = $fixtureSource->getIcon();
            $this->assertIsString($icon);
            $this->assertFalse(in_array($icon, $icons), 'An icon has to be unique');
            $icons[] = $icon;
        }
    }

    public function testFixtureSourceNames(): void
    {
        $names = [];
        foreach ($this->fixtureSources as $fixtureSource) {
            $this->assertInstanceOf(FixtureSourceInterface::class, $fixtureSource);
            $name = $fixtureSource->getName();
            $this->assertIsString($name);
            $this->assertFalse(in_array($name, $names), 'An name has to be unique');
            $names[] = $name;
        }
    }

    /**
     * The following test is redundant.
     */
    public function testFixtureSourcesObjects(): void
    {
        $objects = [];
        foreach ($this->fixtureSources as $fixtureSource) {
            $this->assertInstanceOf(SourceInterface::class, $fixtureSource->getORMReadyObject());
            $this->assertFalse(in_array($fixtureSource, $objects), 'A object has to be unique');
            $objects[] = $fixtureSource;
        }
    }
}
