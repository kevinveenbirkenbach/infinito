<?php

namespace Infinito\Domain\RequestManagement\Right;

use Infinito\Attribut\CrudAttributInterface;
use Infinito\Attribut\RecieverAttributInterface;
use Infinito\Attribut\LayerAttributInterface;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Attribut\RequestedEntityAttributInterface;

/**
 * @author kevinfrantz
 */
interface RequestedRightInterface extends CrudAttributInterface, RecieverAttributInterface, LayerAttributInterface, RequestedEntityAttributInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\SourceAttributInterface::getSource()
     */
    public function getSource(): SourceInterface;
}
