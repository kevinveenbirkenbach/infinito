<?php

namespace Infinito\Domain\FixtureManagement\FixtureSource;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Entity\Meta\Right;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\DBAL\Types\Meta\Right\CRUDType;

/**
 * @author kevinfrantz
 */
final class ImpressumFixtureSource extends AbstractFixtureSource
{
    const SLUG = 'IMPRINT';

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface::getORMReadyObject()
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
        $right->setLaw($impressumSource->getLaw());
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
