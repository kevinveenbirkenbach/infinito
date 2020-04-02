<?php

namespace Infinito\Domain\DataAccess;

use Doctrine\Common\Collections\Collection;

/**
 * @author kevinfrantz
 */
interface ActionsDAOInterface
{
    /**
     * @return mixed The needed data
     */
    public function getData(string $actionType);

    /**
     * @return bool True if the data is set
     */
    public function isDataStored(string $actionType): bool;

    public function getAllStoredData(): Collection;
}
