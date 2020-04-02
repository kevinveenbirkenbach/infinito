<?php

namespace Infinito\Attribut;

use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Exception\Type\InvalidChoiceTypeException;

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
     * @throws InvalidChoiceTypeException
     */
    public function setLayer(string $layer): void
    {
        if (!in_array($layer, LayerType::getValues())) {
            throw new InvalidChoiceTypeException("'$layer' is not a correct layer type.");
        }
        $this->layer = $layer;
    }

    public function getLayer(): string
    {
        return $this->layer;
    }
}
