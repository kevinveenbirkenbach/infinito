<?php

namespace Infinito\Domain\TemplateManagement;

use Doctrine\Common\Collections\Collection;

/**
 * This class offers a temporary data store to pass data from the controller logic to the template.
 *
 * @author kevinfrantz
 *
 * @see https://en.wikipedia.org/wiki/Data_store
 */
interface ActionTemplateDataStoreServiceInterface
{
    /**
     * @param string $actionType
     * @param mixed  $data       The data which a Template needs to be handled
     */
    public function setData(string $actionType, $data): void;

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
