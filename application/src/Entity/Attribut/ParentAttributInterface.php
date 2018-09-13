<?php

namespace Entity\Attribut;

/**
 * @author kevinfrantz
 */
interface ParentAttributInterface
{
    public function setParent(ParentAttributInterface $parent): void;

    public function getParent(): ParentAttributInterface;
}
