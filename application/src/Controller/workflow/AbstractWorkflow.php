<?php
namespace Controller\workflow;

use App\Controller\workflow\WorkflowInterface;
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
    protected $type = 'html';
    
    protected $response;
    
    protected $request;
    
    public function __construct(Request $request){}
    
    abstract protected function handlePost():void;
    
    abstract protected function handleGet():void;

    private function setType():void{}
    
    public function work(): void
    {
        $this->response = new Response();
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

