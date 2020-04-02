<?php

namespace Infinito\Domain\Right;

use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\DBAL\Types\Meta\Right\LayerType;

/**
 * @author kevinfrantz
 */
final class RightLayerCombinationService implements RightLayerCombinationServiceInterface
{
    /**
     * @var array
     */
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

    private function checkIfExcluded(string $layer, string $crud): bool
    {
        return array_key_exists($layer, self::EXLUDED_RIGHTS_BY_LAYER) && in_array($crud, self::EXLUDED_RIGHTS_BY_LAYER[$layer]);
    }

    private function setCombination(): void
    {
        foreach (LayerType::getValues() as $layer) {
            foreach (CRUDType::getValues() as $crud) {
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
     * @see \Infinito\Domain\Right\RightLayerCombinationServiceInterface::getPossibleCruds()
     */
    public function getPossibleCruds(string $layer): array
    {
        return $this->possibleCombinations[$layer];
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Right\RightLayerCombinationServiceInterface::getPossibleLayers()
     */
    public function getPossibleLayers(string $crud): array
    {
        $possibleLayers = [];
        foreach ($this->possibleCombinations as $layer => $possibleCombination) {
            if (in_array($crud, $possibleCombination)) {
                $possibleLayers[] = $layer;
            }
        }

        return $possibleLayers;
    }
}
