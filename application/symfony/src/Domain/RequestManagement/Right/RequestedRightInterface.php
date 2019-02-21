<?php

namespace Infinito\Domain\RequestManagement\Right;

use Infinito\Attribut\RecieverAttributInterface;
use Infinito\Attribut\LayerAttributInterface;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Attribut\RequestedEntityAttributInterface;
use Infinito\Attribut\ActionTypeAttributInterface;

/**
 * @author kevinfrantz
 */
interface RequestedRightInterface extends ActionTypeAttributInterface, RecieverAttributInterface, LayerAttributInterface, RequestedEntityAttributInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\SourceAttributInterface::getSource()
     */
    public function getSource(): SourceInterface;
}
