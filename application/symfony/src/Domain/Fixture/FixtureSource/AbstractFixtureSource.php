<?php

namespace Infinito\Domain\Fixture\FixtureSource;

/**
 * Classes which inhiere from this class and should be loaded by SourceFixtures MUST be declared as final.
 *
 * @author kevinfrantz
 */
abstract class AbstractFixtureSource implements FixtureSourceInterface
{
    /**
     * @var string a human readable name
     */
    protected $name = null;

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Fixture\FixtureSource\FixtureSourceInterface::getName()
     */
    public function getName(): string
    {
        return $this->name ?? self::getSlug();
    }

    public static function getSlug(): string
    {
        $className = get_called_class();
        $exploded = explode('\\', $className);
        $shortname = $exploded[count($exploded) - 1];
        $key = str_replace('FixtureSource', '', $shortname);
        $lower = strtolower($key);

        return $lower;
    }
}
