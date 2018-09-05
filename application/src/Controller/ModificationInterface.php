<?php
namespace App\Controller;

/**
 *
 * @author kevinfrantz
 *        
 */
interface ModificationInterface
{
    public function modify(int $id):Response;
}

