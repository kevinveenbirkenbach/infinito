<?php

namespace Infinito\Domain\Request\Right;

use Infinito\Attribut\ActionTypeAttributInterface;
use Infinito\Attribut\LayerAttributInterface;
use Infinito\Attribut\RecieverAttributInterface;
use Infinito\Attribut\RequestedEntityAttributInterface;
use Infinito\Entity\Source\SourceInterface;

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
