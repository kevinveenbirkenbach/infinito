<?php

namespace App\Entity\Attribut;

use App\Entity\NodeInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
trait ChildsAttribut
{
    /**
     * @var Collection|NodeInterface[]
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
