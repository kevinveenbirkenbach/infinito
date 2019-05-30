<?php

namespace Infinito\Domain\DataAccess;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface ActionsDAOInterface
{
    /**
     * @param string $actionType
     *
     * @return mixed The needed data
     */
    public function getData(string $actionType);

    /**
     * @param string $actionType
     *
     * @return bool True if the data is set
     */
    public function isDataStored(string $actionType): bool;

    /**
     * @return Collection
     */
    public function getAllStoredData(): Collection;
}
