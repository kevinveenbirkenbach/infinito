<?php

namespace Infinito\Domain\FixtureManagement\FixtureSource;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Domain\FixtureManagement\EntityTemplateFactory;

/**
 * @author kevinfrantz
 */
final class InformationFixtureSource extends AbstractFixtureSource
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $informationSource = new TextSource();
        $informationSource->setText('See https://github.com/KevinFrantz/infinito/issues.');
        $informationSource->setSlug(self::getSlug());
        EntityTemplateFactory::createStandartPublicRight($informationSource);

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
