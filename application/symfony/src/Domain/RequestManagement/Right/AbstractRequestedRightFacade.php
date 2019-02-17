<?php

namespace Infinito\Domain\RequestManagement\Right;

use Infinito\Domain\RequestManagement\Entity\RequestedEntityInterface;
use Infinito\Entity\Source\SourceInterface;

/**
 * Offers a facade to wrapp a requested right.
 *
 * @author kevinfrantz
 */
abstract class AbstractRequestedRightFacade implements RequestedRightInterface
{
    /**
     * @var RequestedRightInterface
     */
    protected $requestedRight;

    /**
     * @param RequestedRightInterface $requestedRight
     */
    public function __construct(RequestedRightInterface $requestedRight)
    {
        $this->requestedRight = $requestedRight;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\RecieverAttributInterface::getReciever()
     */
    public function getReciever(): SourceInterface
    {
        return $this->requestedRight->getReciever();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\LayerAttributInterface::setLayer()
     */
    public function setLayer(string $layer): void
    {
        $this->requestedRight->setLayer($layer);
    }

    /**
     * @deprecated
     * {@inheritdoc}
     * @see \Infinito\Domain\RequestManagement\Right\RequestedRightInterface::getSource()
     */
    public function getSource(): SourceInterface
    {
        return $this->requestedRight->getSource();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\LayerAttributInterface::getLayer()
     */
    public function getLayer(): string
    {
        return $this->requestedRight->getLayer();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\RequestedEntityAttributInterface::setRequestedEntity()
     */
    public function setRequestedEntity(RequestedEntityInterface $requestedEntity): void
    {
        $this->requestedRight->setRequestedEntity($requestedEntity);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\CrudAttributInterface::setCrud()
     */
    public function setCrud(string $crud): void
    {
        $this->requestedRight->setCrud($crud);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\CrudAttributInterface::getCrud()
     */
    public function getCrud(): string
    {
        return $this->requestedRight->getCrud();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\RequestedEntityAttributInterface::getRequestedEntity()
     */
    public function getRequestedEntity(): RequestedEntityInterface
    {
        return $this->requestedRight->getRequestedEntity();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\RecieverAttributInterface::setReciever()
     */
    public function setReciever(?SourceInterface $reciever): void
    {
        $this->requestedRight->setReciever($reciever);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\RequestedEntityAttributInterface::hasRequestedEntity()
     */
    public function hasRequestedEntity(): bool
    {
        return $this->requestedRight->hasRequestedEntity();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\RecieverAttributInterface::hasReciever()
     */
    public function hasReciever(): bool
    {
        return $this->requestedRight->hasReciever();
    }
}
