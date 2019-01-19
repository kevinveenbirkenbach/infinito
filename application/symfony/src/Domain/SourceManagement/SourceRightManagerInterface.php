<?php

namespace App\Domain\SourceManagement;

use App\Entity\Meta\RightInterface;
use App\Exception\AllreadySetException;
use App\Exception\AllreadyDefinedException;
use App\Exception\NotSetException;

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
