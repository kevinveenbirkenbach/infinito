<?php

namespace App\Creator\Modificator\Entity;

use App\DBAL\Types\LayerType;
use App\DBAL\Types\RightType;
use App\Entity\NodeInterface;
use App\Entity\Right;
use App\Entity\LawInterface;

/**
 * @author kevinfrantz
 */
abstract class LawModificator
{
    public static function grantAllRights(LawInterface $law, NodeInterface $node): void
    {
        foreach (LayerType::getChoices() as $layerKey => $layerValue) {
            foreach (RightType::getChoices() as $rightKey => $rightValue) {
                $right = new Right();
                $right->setType($rightKey);
                $right->setLaw($this);
                $right->setLayer($layerKey);
                $right->setNode($node);
                $law->getRights()->add($right);
            }
        }
    }
}
