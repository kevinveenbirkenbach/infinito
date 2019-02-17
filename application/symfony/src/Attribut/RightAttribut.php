<?php

namespace Infinito\Attribut;

use Infinito\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 */
trait RightAttribut
{
    /**
     * @var RightInterface
     */
    protected $right;

    public function setRight(RightInterface $right): void
    {
        $this->right = $right;
    }

    public function getRight(): RightInterface
    {
        return $this->right;
    }
}
