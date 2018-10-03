<?php
namespace App\Controller;

use App\Entity\EntityInterface;
use FOS\RestBundle\Controller\FOSRestController;

/**
 *
 * @author kevinfrantz
 *        
 */
abstract class AbstractEntityController extends FOSRestController
{
    /**
     * @var string
     */
    protected $entityName;
    
    public function __construct(){
        $this->setEntityName();
    }
    
    abstract protected function setEntityName():void;
    
    protected function loadEntityById(int $id): EntityInterface
    {
        $entity = $this->getDoctrine()
        ->getRepository($this->entityName)
        ->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('No entity found for id '.$id);
        }
        return $entity;
    }
}