<?php

namespace Infinito\Domain\Fixture\FixtureSource;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Domain\Fixture\EntityTemplateFactory;

/**
 * @author kevinfrantz
 */
final class InformationFixtureSource extends AbstractFixtureSource
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Fixture\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $informationSource = new TextSource();
        $informationSource->setText('See https://github.com/KevinFrantz/infinito/issues.');
        $informationSource->setSlug(self::getSlug());
        EntityTemplateFactory::createStandartPublicRights($informationSource);

        return $informationSource;
    }

    /**
     * @return string
     */
    public static function getIcon(): string
    {
        return 'fas fa-info';
    }
}
