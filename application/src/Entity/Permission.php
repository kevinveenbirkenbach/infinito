<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\BlacklistAttribut;
use App\Entity\Attribut\WhitelistAttribut;
use App\Entity\Attribut\NodeAttribut;
use App\Entity\Attribut\RightAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="permission")
 * @ORM\Entity(repositoryClass="App\Repository\PermissionRepository")
 */
class Permission extends AbstractEntity implements PermissionInterface
{
    use BlacklistAttribut,WhitelistAttribut,NodeAttribut,RightAttribut;

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

    /**
     * @ORM\ManyToOne(targetEntity="Node")
     * @ORM\JoinColumn(name="node_id", referencedColumnName="id")
     *
     * @var NodeInterface
     */
    protected $node;

    /**
     * @ORM\ManyToOne(targetEntity="Right")
     * @ORM\JoinColumn(name="right_id", referencedColumnName="id")
     *
     * @var RightInterface
     */
    protected $right;
}
