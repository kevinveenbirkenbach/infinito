<?php

namespace App\Domain\FixtureManagement\FixtureSource;

use App\Entity\Source\SourceInterface;
use App\Entity\Source\Primitive\Text\TextSource;
use App\Entity\Meta\Right;
use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;

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
        $right = new Right();
        $right->setSource($impressumSource);
        $right->setLayer(LayerType::SOURCE);
        $right->setCrud(CRUDType::READ);
        $impressumSource->getLaw()->getRights()->add($right);

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
