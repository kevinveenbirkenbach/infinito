<?php

namespace Infinito\Attribut;

use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Exception\NoValidChoiceException;

/**
 * @author kevinfrantz
 *
 * @see LayerAttributInterface
 */
trait LayerAttribut
{
    /**
     * @see LayerType
     *
     * @var string
     */
    protected $layer;

    /**
     * @param string $layer
     *
     * @throws NoValidChoiceException
     */
    public function setLayer(string $layer): void
    {
        if (!in_array($layer, LayerType::getValues())) {
            throw new NoValidChoiceException("'$layer' is not a correct layer type.");
        }
        $this->layer = $layer;
    }

    /**
     * @return string
     */
    public function getLayer(): string
    {
        return $this->layer;
    }
}
