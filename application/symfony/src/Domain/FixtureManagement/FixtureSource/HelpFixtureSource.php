<?php

namespace Infinito\Domain\FixtureManagement\FixtureSource;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Domain\FixtureManagement\EntityTemplateFactory;

/**
 * @author kevinfrantz
 */
final class HelpFixtureSource extends AbstractFixtureSource
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $helpSource = new TextSource();
        $helpSource->setText('See https://github.com/KevinFrantz/infinito/issues.');
        $helpSource->setSlug(self::getSlug());
        EntityTemplateFactory::createStandartPublicRights($helpSource);

        return $helpSource;
    }

    /**
     * @return string
     */
    public static function getIcon(): string
    {
        return 'fas fa-question';
    }
}
