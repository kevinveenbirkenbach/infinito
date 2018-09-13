<?php
namespace App\Entity;

use App\Entity\Attribut\UserAttributInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface UserSourceInterface extends SourceInterface, UserAttributInterface
{
}

