<?php

namespace Infinito\Domain\DataAccessManagement;

/**
 * @author kevinfrantz
 */
interface ActionsResultsDAOServiceInterface extends ActionsDAOInterface
{
    /**
     * @param string $actionType
     * @param mixed  $data       The data which a Template needs to be handled
     */
    public function setData(string $actionType, $data): void;
}
