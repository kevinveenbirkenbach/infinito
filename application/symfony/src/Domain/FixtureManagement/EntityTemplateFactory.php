<?php

namespace Infinito\Domain\FixtureManagement;

use Infinito\Entity\Meta\Right;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\DBAL\Types\ActionType;
use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
final class EntityTemplateFactory extends Right
{
    /**
     * @param SourceInterface $source
     */
    public static function createStandartPublicRight(SourceInterface $source): Right
    {
        $right = new Right();
        $law = $source->getLaw();
        $right->setLaw($law);
        $law->getRights()->add($right);
        $right->setSource($source);
        $right->setLayer(LayerType::SOURCE);
        $right->setActionType(ActionType::READ);

        return $right;
    }
}
