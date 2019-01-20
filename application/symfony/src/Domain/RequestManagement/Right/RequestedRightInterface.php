<?php

namespace App\Domain\RequestManagement\Right;

use App\Attribut\CrudAttributInterface;
use App\Attribut\RecieverAttributInterface;
use App\Attribut\LayerAttributInterface;
use App\Entity\Source\SourceInterface;
use App\Attribut\RequestedEntityAttributInterface;

/**
 * @author kevinfrantz
 */
interface RequestedRightInterface extends CrudAttributInterface, RecieverAttributInterface, LayerAttributInterface, RequestedEntityAttributInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\SourceAttributInterface::getSource()
     */
    public function getSource(): SourceInterface;
}
