<?php

namespace Infinito\Domain\Fixture\FixtureSource;

use Infinito\Domain\Fixture\EntityTemplateFactory;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
final class ImpressumFixtureSource extends AbstractFixtureSource
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Fixture\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $impressumSource = new TextSource();
        $impressumSource->setText('Example Impressum');
        $impressumSource->setSlug(self::getSlug());
        EntityTemplateFactory::createStandartPublicRights($impressumSource);

        return $impressumSource;
    }

    public static function getIcon(): string
    {
        return 'fas fa-address-card';
    }
}
