<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Law;
/**
 *
 * @author kevinfrantz
 *        
 */
class LawController extends AbstractEntityController
{
    /**
     * @Route("/law/{id}.{_format}", defaults={"_format"="html"})
     */
    public function show():Response{
        //Implement
    }
    
    /**
     * @Route("/law/{id}/right.{_format}", defaults={"_format"="html"})
     */
    public function right(int $id):RedirectResponse{
        //Implement
    }
    
    /**
     * @Route("/law/{id}/node.{_format}", defaults={"_format"="html"})
     */
    public function node(int $id):RedirectResponse{
        //Implement
    }
    
    protected function setEntityName(): void
    {
        $this->entityName = Law::class;
    }

}