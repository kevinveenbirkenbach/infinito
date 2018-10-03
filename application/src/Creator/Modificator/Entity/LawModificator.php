<?php

namespace App\Creator\Modificator\Entity;

use App\DBAL\Types\LayerType;
use App\DBAL\Types\RightType;
use App\Entity\NodeInterface;
use App\Entity\Right;
use App\Entity\LawInterface;
use App\DBAL\Types\RecieverType;
use App\Entity\RightInterface;
use App\Entity\RecieverGroupInterface;
use App\Entity\RecieverGroup;

/**
 * @author kevinfrantz
 */
abstract class LawModificator
{
    public static function grantAllRights(LawInterface $law, NodeInterface $node): void
    {
        foreach (LayerType::getChoices() as $layerKey => $layerValue) {
            foreach (RightType::getChoices() as $rightKey => $rightValue) {
                $right = self::createRight($law, $node, $rightKey, $layerKey);
                $right->setRecieverGroup(self::createRecieverGroup($node, RecieverType::NODE));
                $law->getRights()->add($right);
            }
        }
    }

    public static function createRight(LawInterface $law, NodeInterface $node, string $type, string $layer): RightInterface
    {
        $right = new Right();
        $right->setType($type);
        $right->setLaw($law);
        $right->setLayer($layer);
        $right->setNode($node);

        return $right;
    }

    public static function createRecieverGroup(NodeInterface $node, string $reciever): RecieverGroupInterface
    {
        $recieverGroup = new RecieverGroup();
        $recieverGroup->setNode($node);
        $recieverGroup->setReciever($reciever);

        return $recieverGroup;
    }
}
