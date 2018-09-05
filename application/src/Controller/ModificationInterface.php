<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @author kevinfrantz
 *        
 */
interface ModificationInterface
{
    public function modify(int $id):Response;
}

