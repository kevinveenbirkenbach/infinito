<?php

namespace App\Domain\RightManagement\RightRequestManagement;

use App\Entity\Attribut\TypeAttributInterface;
use App\Entity\Attribut\RecieverAttributInterface;
use App\Entity\Attribut\LayerAttributInterface;
use App\Domain\SourceManagement\RequestedSourceInterface;
use App\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
interface RequestedRightInterface extends TypeAttributInterface, RecieverAttributInterface, LayerAttributInterface
{
    /**
     * @param RequestedSourceInterface $requestedSource
     */
    public function setRequestedSource(RequestedSourceInterface $requestedSource);

    /**
     * {@inheritdoc}
     *
     * @see \App\Entity\Attribut\SourceAttributInterface::getSource()
     */
    public function getSource(): SourceInterface;
}
