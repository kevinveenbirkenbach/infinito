<?php

namespace App\Domain\RequestManagement;

use App\Entity\Source\SourceInterface;
use App\Domain\UserManagement\UserSourceDirectorInterface;
use App\Exception\SetNotPossibleException;

/**
 * @author kevinfrantz
 */
class RequestedUserRight implements RequestedUserRightInterface
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
     * @see \App\Entity\Attribut\RecieverAttributInterface::setReciever()
     */
    public function setReciever(SourceInterface $reciever): void
    {
        throw new SetNotPossibleException('It\'s not possible to set the reciever!');
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Entity\Attribut\RecieverAttributInterface::getReciever()
     */
    public function getReciever(): SourceInterface
    {
        return $this->userSourceDirector->getUser()->getSource();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Entity\Attribut\LayerAttributInterface::setLayer()
     */
    public function setLayer(string $layer): void
    {
        $this->requestedRight->setLayer($layer);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Entity\Attribut\CrudAttributInterface::getCrud()
     */
    public function getCrud(): string
    {
        return $this->requestedRight->getCrud();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Entity\Attribut\LayerAttributInterface::getLayer()
     */
    public function getLayer(): string
    {
        return $this->requestedRight->getLayer();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Entity\Attribut\SourceAttributInterface::getSource()
     */
    public function getSource(): SourceInterface
    {
        return $this->requestedRight->getSource();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Entity\Attribut\CrudAttributInterface::setCrud()
     */
    public function setCrud(string $type): void
    {
        $this->requestedRight->setCrud($type);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RequestManagement\RequestedRightInterface::setRequestedSource()
     */
    public function setRequestedSource(RequestedSourceInterface $requestedSource)
    {
        $this->requestedRight->setRequestedSource($requestedSource);
    }
}
