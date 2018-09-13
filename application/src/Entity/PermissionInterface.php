<?php
namespace Entity;

use App\Entity\Attribut\BlacklistAttributInterface;
use Entity\Attribut\WhitelistAttributInterface;

/**
 *
 * @author kevinfrantz
 *        
 */
interface PermissionInterface extends BlacklistAttributInterface, WhitelistAttributInterface
{
}

