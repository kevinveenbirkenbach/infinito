<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @author kevinfrantz
 *        
 */
interface ActivationInterface
{
    public function deactivate():Response;
    
    public function activate():Response;
}

