<?php
namespace App\Controller\workflow;

use App\Entity\NodeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @author kevinfrantz
 *        
 */
abstract class AbstractWorkflow implements WorkflowInterface
{
    protected $template;
    
    protected $type = 'html';
    
    protected $response;
    
    protected $request;
    
    public function __construct(){
        $this->response = new Response();
    }
    
    abstract protected function handlePost():void;
    
    abstract protected function handleGet():void;

    private function setType():void{}
    
    public function work(): void
    {
        $this->setType();
        $this->handlePost();
        $this->handleGet();
    }
    
    public function setReguest(Request $request): void
    {
    }

    public function getReponse(): Response
    {}

    public function setWorker(NodeInterface $worker): void
    {}

}

