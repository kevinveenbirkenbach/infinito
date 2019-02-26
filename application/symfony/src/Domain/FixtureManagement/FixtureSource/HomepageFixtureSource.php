<?php

namespace Infinito\Domain\FixtureManagement\FixtureSource;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Entity\Meta\Right;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\DBAL\Types\ActionType;

/**
 * @author kevinfrantz
 */
final class HomepageFixtureSource extends AbstractFixtureSource
{
    /**
     * @var string
     */
    const SLUG = 'HOMEPAGE';

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $impressumSource = new TextSource();
        $impressumSource->setText('Welcome to infinito!');
        $impressumSource->setSlug(self::SLUG);
        $right = new Right();
        $right->setSource($impressumSource);
        $right->setLayer(LayerType::SOURCE);
        $right->setActionType(ActionType::READ);
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
