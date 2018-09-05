<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @author kevinfrantz
 *        
 */
interface UserControllerInterface
{
    public function logout():Response;
    
    public function login():Response;
    
    public function register():Response;
}
