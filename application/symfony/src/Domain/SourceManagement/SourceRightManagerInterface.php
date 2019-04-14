<?php

namespace Infinito\Domain\SourceManagement;

use Infinito\Entity\Meta\RightInterface;

/**
 * Allows to add and remove rights of a source.
 *
 * @author kevinfrantz
 */
interface SourceRightManagerInterface
{
    /**
     * @param RightInterface $right
     */
    public function addRight(RightInterface $right): void;

    /**
     * @param RightInterface $right
     */
    public function removeRight(RightInterface $right): void;
}
