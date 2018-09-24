<?php

namespace Entity\Attribut;

use App\Entity\Attribut\Interfaces\ParentAttributInterface;

/**
 * @author kevinfrantz
 */
trait ParentAttribut
{
    /**
     * @var ParentAttributInterface
     */
    protected $parent;

    public function setParent(ParentAttributInterface $parent): void
    {
        $this->parent = $parent;
    }

    public function getParent(): ParentAttributInterface
    {
        return $this->parent;
    }
}
