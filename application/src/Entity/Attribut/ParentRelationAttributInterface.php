<?php
namespace App\Entity\Attribut;

use App\Entity\Meta\Relation\Parent\ParentRelationInterface;

interface ParentRelationAttributInterface
{
    public function setParentRelation(ParentRelationInterface $parentRelation):void;
    
    public function getParentRelation():ParentRelationInterface;
} 

