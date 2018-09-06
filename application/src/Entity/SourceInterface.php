<?php
namespace App\Entity;

use App\Entity\attribut\NodeAttributInterface;
use App\Entity\attribut\IdAttributInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface SourceInterface extends IdAttributInterface, NodeAttributInterface
{
}

