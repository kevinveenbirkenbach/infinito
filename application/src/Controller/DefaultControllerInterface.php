<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @author kevinfrantz
 *        
 */
interface DefaultControllerInterface
{
    public function homepage():Response;
    
    public function imprint():Response;
}

