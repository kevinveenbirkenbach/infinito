<?php

namespace Infinito\Domain\FixtureManagement;

use Infinito\Entity\Meta\Right;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\DBAL\Types\ActionType;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Meta\RightInterface;
use Infinito\Entity\Meta\LawInterface;

/**
 * @author kevinfrantz
 */
final class EntityTemplateFactory extends Right
{
    /**
     * @param LawInterface   $law
     * @param RightInterface $right
     */
    private static function addRightToLaw(LawInterface $law, RightInterface $right)
    {
        $right->setLaw($law);
        $law->getRights()->add($right);
    }

    /**
     * @param SourceInterface $source
     */
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
