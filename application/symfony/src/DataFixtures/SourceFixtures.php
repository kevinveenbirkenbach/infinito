<?php

namespace Infinito\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Infinito\Domain\Fixture\FixtureSourceFactory;

/**
 * @author kevinfrantz
 */
class SourceFixtures extends Fixture
{
    /**
     * {@inheritdoc}
     *
     * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
     */
    public function load(ObjectManager $manager)
    {
        $fixtureSources = FixtureSourceFactory::getAllFixtureSources();
        foreach ($fixtureSources as $fixtureSource) {
            $manager->persist($fixtureSource->getORMReadyObject());
        }
        $manager->flush();
    }
}
