<?php
namespace App\Controller\workflow;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\NodeInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface WorkflowInterface
{
    public function setWorker(NodeInterface $worker):void;
    
    public function setReguest(Request $request):void;
    
    public function work():void;
    
    public function getReponse():Response;
}

