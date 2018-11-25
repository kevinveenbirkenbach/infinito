<?php
namespace App\Entity\Attribut;

use App\Entity\Meta\Relation\CreatorRelationInterface;

trait CreatorRelationAttribut
{
    /**
     * @var CreatorRelationInterface
     */
    protected $creatorRelation;
    
    public function setCreatorRelation(CreatorRelationInterface $creatorRelation){
        $this->creatorRelation = $creatorRelation;
    }
    
    public function getCreatorRelation():CreatorRelationInterface{
        return $this->creatorRelation;
    }
}

