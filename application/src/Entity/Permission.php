<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\BlacklistAttribut;
use App\Entity\Attribut\WhitelistAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="permission")
 * @ORM\Entity(repositoryClass="App\Repository\PermissionRepository")
 */
class Permission extends AbstractEntity implements PermissionInterface
{
    use BlacklistAttribut,WhitelistAttribut;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    protected $blacklist;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    protected $whitelist;
}
