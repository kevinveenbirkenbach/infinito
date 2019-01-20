<?php

namespace App\Domain\RequestManagement\Right;

use App\Attribut\CrudAttributInterface;
use App\Attribut\RecieverAttributInterface;
use App\Attribut\LayerAttributInterface;
use App\Entity\Source\SourceInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;

/**
 * @author kevinfrantz
 */
interface RequestedRightInterface extends CrudAttributInterface, RecieverAttributInterface, LayerAttributInterface
{
    /**
     * @param RequestedEntityInterface $requestedSource
     */
    public function setRequestedEntity(RequestedEntityInterface $requestedSource): void;

    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\SourceAttributInterface::getSource()
     */
    public function getSource(): SourceInterface;
}
