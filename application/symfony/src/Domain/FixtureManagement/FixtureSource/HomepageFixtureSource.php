<?php

namespace Infinito\Domain\FixtureManagement\FixtureSource;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Domain\FixtureManagement\EntityTemplateFactory;

/**
 * @author kevinfrantz
 */
final class HomepageFixtureSource extends AbstractFixtureSource
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $homepage = new TextSource();
        $homepage->setText('Welcome to infinito!');
        $homepage->setSlug(self::getSlug());
        EntityTemplateFactory::createStandartPublicRight($homepage);

        return $homepage;
    }

    public static function getIcon(): string
    {
        return 'fas fa-home';
    }
}
