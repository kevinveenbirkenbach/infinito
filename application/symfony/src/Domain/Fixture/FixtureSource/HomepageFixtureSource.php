<?php

namespace Infinito\Domain\Fixture\FixtureSource;

use Infinito\Domain\Fixture\EntityTemplateFactory;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
final class HomepageFixtureSource extends AbstractFixtureSource
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Fixture\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $homepage = new TextSource();
        $homepage->setText('Welcome to infinito!');
        $homepage->setSlug(self::getSlug());
        EntityTemplateFactory::createStandartPublicRights($homepage);

        return $homepage;
    }

    public static function getIcon(): string
    {
        return 'fas fa-home';
    }
}
