<?php

namespace App\Domain\FixtureManagement\FixtureSource;

use App\Entity\Source\SourceInterface;
use App\Entity\Source\Primitive\Text\TextSource;

/**
 * @author kevinfrantz
 */
final class ImpressumFixtureSource extends AbstractFixtureSource
{
    const SLUG = 'IMPRINT';

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $impressumSource = new TextSource();
        $impressumSource->setText('Example Impressum');
        $impressumSource->setSlug(self::SLUG);

        return $impressumSource;
    }

    /**
     * @return string
     */
    public static function getSlug(): string
    {
        return self::SLUG;
    }
}
