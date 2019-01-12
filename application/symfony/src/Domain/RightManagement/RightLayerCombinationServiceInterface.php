<?php

namespace App\Domain\RightManagement;

use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;

/**
 * @author kevinfrantz
 */
interface RightLayerCombinationServiceInterface
{
    /**
     * For layer parameter see:.
     *
     * @see LayerType::getChoices()
     *
     * @param string $layer
     *
     * @return array The cruds which exist for a layer
     */
    public function getPossibleCruds(string $layer): array;

    /**
     * For layer parameter see:.
     *
     * @see CRUDType::getChoices()
     *
     * @param string $crud
     *
     * @return array The layers which exist for a right
     */
    public function getPossibleLayers(string $crudType): array;
}
