<?php

namespace Infinito\Domain\Source;

use Infinito\Entity\Meta\RightInterface;

/**
 * Allows to add and remove rights of a source.
 *
 * @author kevinfrantz
 */
interface SourceRightManagerInterface
{
    public function addRight(RightInterface $right): void;

    public function removeRight(RightInterface $right): void;
}
