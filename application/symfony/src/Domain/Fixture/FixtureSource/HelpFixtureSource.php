<?php

namespace Infinito\Domain\Fixture\FixtureSource;

use Infinito\Domain\Fixture\EntityTemplateFactory;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
final class HelpFixtureSource extends AbstractFixtureSource
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Fixture\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $helpSource = new TextSource();
        $helpSource->setText('See https://github.com/KevinFrantz/infinito/issues.');
        $helpSource->setSlug(self::getSlug());
        EntityTemplateFactory::createStandartPublicRights($helpSource);

        return $helpSource;
    }

    public static function getIcon(): string
    {
        return 'fas fa-question';
    }
}
