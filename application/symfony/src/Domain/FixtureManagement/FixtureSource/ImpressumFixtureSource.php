<?php

namespace Infinito\Domain\FixtureManagement\FixtureSource;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Domain\FixtureManagement\EntityTemplateFactory;

/**
 * @author kevinfrantz
 */
final class ImpressumFixtureSource extends AbstractFixtureSource
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $impressumSource = new TextSource();
        $impressumSource->setText('Example Impressum');
        $impressumSource->setSlug(self::getSlug());
        EntityTemplateFactory::createStandartPublicRights($impressumSource);

        return $impressumSource;
    }

    /**
     * @return string
     */
    public static function getIcon(): string
    {
        return 'fas fa-address-card';
    }
}
