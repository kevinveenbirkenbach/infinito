<?php

namespace App\Creator\Modificator\Entity;

use App\DBAL\Types\LayerType;
use App\DBAL\Types\RightType;
use App\Entity\Meta\RelationInterface;
use App\Entity\Meta\Right;
use App\Entity\Meta\LawInterface;
use App\DBAL\Types\RecieverType;
use App\Entity\Meta\RightInterface;
use App\Entity\Meta\RecieverInterface;
use App\Entity\Meta\Reciever;

/**
 * @author kevinfrantz
 */
abstract class LawModificator
{
    public static function grantAllRights(LawInterface $law, RelationInterface $node): void
    {
        foreach (LayerType::getChoices() as $layerKey => $layerValue) {
            foreach (RightType::getChoices() as $rightKey => $rightValue) {
                $right = self::createRight($law, $node, $rightKey, $layerKey);
                //$right->setRecieverGroup(self::createRecieverGroup($node, RecieverType::NODE));
                $law->getRights()->add($right);
            }
        }
    }

    public static function createRight(LawInterface $law, RelationInterface $node, string $type, string $layer): RightInterface
    {
        $right = new Right();
        $right->setType($type);
        $right->setLaw($law);
        $right->setLayer($layer);
        $right->setNode($node);

        return $right;
    }

    public static function createRecieverGroup(RelationInterface $node, string $reciever): RecieverInterface
    {
        $recieverGroup = new Reciever();
        $recieverGroup->setNode($node);
        $recieverGroup->setReciever($reciever);

        return $recieverGroup;
    }
}
