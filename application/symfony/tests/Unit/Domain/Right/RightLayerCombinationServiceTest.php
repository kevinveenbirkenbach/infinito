<?php

namespace tests\Unit\Domain\Right;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Right\RightLayerCombinationServiceInterface;
use Infinito\Domain\Right\RightLayerCombinationService;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\DBAL\Types\Meta\Right\LayerType;

/**
 * @author kevinfrantz
 */
class RightLayerCombinationServiceTest extends TestCase
{
    /**
     * @var RightLayerCombinationServiceInterface
     */
    public $rightLayerCombinationService;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp()
    {
        $this->rightLayerCombinationService = new RightLayerCombinationService();
    }

    public function testBySource(): void
    {
        foreach (CRUDType::getValues() as $crudType) {
            $layers = $this->rightLayerCombinationService->getPossibleLayers($crudType);
            $this->assertContains(LayerType::SOURCE, $layers);
            $sourceCruds = $this->rightLayerCombinationService->getPossibleCruds(LayerType::SOURCE);
            $this->assertContains($crudType, $sourceCruds);
        }
    }

    public function testByLaw(): void
    {
        foreach ([CRUDType::DELETE, CRUDType::CREATE] as $crudType) {
            $layers = $this->rightLayerCombinationService->getPossibleLayers($crudType);
            $this->assertNotContains(LayerType::LAW, $layers);
            $sourceCruds = $this->rightLayerCombinationService->getPossibleCruds(LayerType::LAW);
            $this->assertNotContains($crudType, $sourceCruds);
        }
        foreach ([CRUDType::READ, CRUDType::UPDATE] as $crudType) {
            $layers = $this->rightLayerCombinationService->getPossibleLayers($crudType);
            $this->assertContains(LayerType::LAW, $layers);
            $sourceCruds = $this->rightLayerCombinationService->getPossibleCruds(LayerType::LAW);
            $this->assertContains($crudType, $sourceCruds);
        }
    }
}
