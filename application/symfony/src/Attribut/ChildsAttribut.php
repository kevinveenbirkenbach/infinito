<?php

namespace App\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * @see ChildsAttributInterface
 *
 * @author kevinfrantz
 */
trait ChildsAttribut
{
    /**
     * @var Collection|ChildsAttributInterface[]
     */
    protected $childs;

    public function getChilds(): Collection
    {
        return $this->childs;
    }

    public function setChilds(Collection $childs): void
    {
        $this->childs = $childs;
    }
}
