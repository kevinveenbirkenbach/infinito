<?php

namespace App\Domain\RequestManagement\Right;

use App\Entity\Attribut\CrudAttributInterface;
use App\Entity\Attribut\RecieverAttributInterface;
use App\Entity\Attribut\LayerAttributInterface;
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
    public function setRequestedEntity(RequestedEntityInterface $requestedSource);

    /**
     * {@inheritdoc}
     *
     * @see \App\Entity\Attribut\SourceAttributInterface::getSource()
     */
    public function getSource(): SourceInterface;
}
