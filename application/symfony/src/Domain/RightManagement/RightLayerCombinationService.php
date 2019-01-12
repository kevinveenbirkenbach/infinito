<?php

namespace App\Domain\RightManagement;

use App\DBAL\Types\Meta\Right\LayerType;
use App\DBAL\Types\Meta\Right\CRUDType;

/**
 * @author kevinfrantz
 */
final class RightLayerCombinationService implements RightLayerCombinationServiceInterface
{
    const EXLUDED_RIGHTS_BY_LAYER = [
        LayerType::HEREDITY => [
            CRUDType::CREATE,
            CRUDType::DELETE,
        ],
        LayerType::LAW => [
            CRUDType::CREATE,
            CRUDType::DELETE,
        ],
    ];

    /**
     * @var array[] Array of string arrays
     */
    private $possibleCombinations = [];

    public function __construct()
    {
        $this->setCombination();
    }

    /**
     * @param string $layer
     * @param string $crud
     *
     * @return bool
     */
    private function checkIfExcluded(string $layer, string $crud): bool
    {
        return array_key_exists($layer, self::EXLUDED_RIGHTS_BY_LAYER) && in_array($crud, self::EXLUDED_RIGHTS_BY_LAYER[$layer]);
    }

    private function setCombination(): void
    {
        foreach (LayerType::getChoices() as $layer) {
            foreach (CRUDType::getChoices() as $crud) {
                if (!array_key_exists($layer, $this->possibleCombinations)) {
                    $this->possibleCombinations[$layer] = [];
                }
                if (!$this->checkIfExcluded($layer, $crud)) {
                    $this->possibleCombinations[$layer][] = $crud;
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RightManagement\RightLayerCombinationServiceInterface::getPossibleCruds()
     */
    public function getPossibleCruds(string $layer): array
    {
        return $this->possibleCombinations[$layer];
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RightManagement\RightLayerCombinationServiceInterface::getPossibleLayers()
     */
    public function getPossibleLayers(string $crudType): array
    {
        $possibleLayers = [];
        foreach ($this->possibleCombinations as $layer => $possibleCombination) {
            if (in_array($crudType, $possibleCombination)) {
                $possibleLayers[] = $layer;
            }
        }

        return $possibleLayers;
    }
}
