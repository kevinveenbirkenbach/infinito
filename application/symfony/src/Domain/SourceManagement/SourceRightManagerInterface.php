<?php

namespace Infinito\Domain\SourceManagement;

use Infinito\Entity\Meta\RightInterface;
use Infinito\Exception\AllreadySetException;
use Infinito\Exception\AllreadyDefinedException;
use Infinito\Exception\NotSetException;

/**
 * Allows to add and remove rights of a source.
 *
 * @author kevinfrantz
 */
interface SourceRightManagerInterface
{
    /**
     * @param RightInterface $right
     *
     * @throws AllreadySetException
     * @throws AllreadyDefinedException
     */
    public function addRight(RightInterface $right): void;

    /**
     * @param RightInterface $right
     *
     * @throws NotSetException
     */
    public function removeRight(RightInterface $right): void;
}
