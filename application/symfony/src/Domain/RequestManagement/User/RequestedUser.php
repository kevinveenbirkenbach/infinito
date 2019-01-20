<?php

namespace App\Domain\RequestManagement\User;

use App\Entity\Source\SourceInterface;
use App\Domain\UserManagement\UserSourceDirectorInterface;
use App\Exception\SetNotPossibleException;
use App\Domain\RequestManagement\Right\RequestedRightInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;

/**
 * @author kevinfrantz
 */
class RequestedUser implements RequestedUserInterface
{
    /**
     * @var UserSourceDirectorInterface
     */
    private $userSourceDirector;

    /**
     * @var RequestedRightInterface
     */
    private $requestedRight;

    /**
     * @param UserSourceDirectorInterface $userSourceDirector
     */
    public function __construct(UserSourceDirectorInterface $userSourceDirector, RequestedRightInterface $requestedRight)
    {
        $this->userSourceDirector = $userSourceDirector;
        $this->requestedRight = $requestedRight;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\RecieverAttributInterface::setReciever()
     */
    public function setReciever(SourceInterface $reciever): void
    {
        throw new SetNotPossibleException('It\'s not possible to set the reciever!');
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\RecieverAttributInterface::getReciever()
     */
    public function getReciever(): SourceInterface
    {
        return $this->userSourceDirector->getUser()->getSource();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\LayerAttributInterface::setLayer()
     */
    public function setLayer(string $layer): void
    {
        $this->requestedRight->setLayer($layer);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\CrudAttributInterface::getCrud()
     */
    public function getCrud(): string
    {
        return $this->requestedRight->getCrud();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\LayerAttributInterface::getLayer()
     */
    public function getLayer(): string
    {
        return $this->requestedRight->getLayer();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\SourceAttributInterface::getSource()
     */
    public function getSource(): SourceInterface
    {
        return $this->requestedRight->getSource();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\CrudAttributInterface::setCrud()
     */
    public function setCrud(string $type): void
    {
        $this->requestedRight->setCrud($type);
    }

    /**
     * @param RequestedEntityInterface $requestedSource
     */
    public function setRequestedEntity(RequestedEntityInterface $requestedSource): void
    {
        $this->requestedRight->setRequestedEntity($requestedSource);
    }
}
