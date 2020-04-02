<?php

namespace Infinito\Domain\Fixture;

use Infinito\DBAL\Types\ActionType;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Entity\Meta\LawInterface;
use Infinito\Entity\Meta\Right;
use Infinito\Entity\Meta\RightInterface;
use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
final class EntityTemplateFactory extends Right
{
    private static function addRightToLaw(LawInterface $law, RightInterface $right)
    {
        $right->setLaw($law);
        $law->getRights()->add($right);
    }

    public static function createStandartPublicRights(SourceInterface $source): void
    {
        $law = $source->getLaw();
        $readRight = new Right();
        self::addRightToLaw($law, $readRight);
        $readRight->setSource($source);
        $readRight->setLayer(LayerType::SOURCE);
        $readRight->setActionType(ActionType::READ);
        $executeRight = new Right();
        self::addRightToLaw($law, $executeRight);
        $executeRight->setSource($source);
        $executeRight->setLayer(LayerType::SOURCE);
        $executeRight->setActionType(ActionType::EXECUTE);
    }
}
