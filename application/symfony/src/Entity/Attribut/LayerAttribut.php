<?php

namespace App\Entity\Attribut;

use App\DBAL\Types\Meta\Right\LayerType;
use App\Exception\NoValidChoiceException;

/**
 * @author kevinfrantz
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
        if (!array_key_exists($layer, LayerType::getChoices())) {
            throw new NoValidChoiceException();
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
