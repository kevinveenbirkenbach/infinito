<?php

namespace Infinito\Domain\Request\User;

use Infinito\Domain\Request\Right\AbstractRequestedRightFacade;
use Infinito\Domain\Request\Right\RequestedRightInterface;
use Infinito\Domain\User\UserSourceDirectorInterface;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Exception\Collection\NotPossibleSetElementException;

/**
 * @author kevinfrantz
 */
class RequestedUser extends AbstractRequestedRightFacade implements RequestedUserInterface
{
    /**
     * @var UserSourceDirectorInterface
     */
    private $userSourceDirector;

    public function __construct(UserSourceDirectorInterface $userSourceDirector, RequestedRightInterface $requestedRight)
    {
        $this->userSourceDirector = $userSourceDirector;
        parent::__construct($requestedRight);
    }

    /**
     * You MUST NO use this method! Use UserSourceDirector instead!
     *
     * @see UserSourceDirectorInterface
     * @deprecated
     * {@inheritdoc}
     * @see \Infinito\Attribut\RecieverAttributInterface::setReciever()
     */
    public function setReciever(?SourceInterface $reciever): void
    {
        throw new NotPossibleSetElementException('It\'s not possible to set the reciever! Set it via '.UserSourceDirectorInterface::class.'!');
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\RecieverAttributInterface::getReciever()
     */
    public function getReciever(): SourceInterface
    {
        return $this->userSourceDirector->getUser()->getSource();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Request\User\RequestedUserInterface::getUserSourceDirector()
     */
    public function getUserSourceDirector(): UserSourceDirectorInterface
    {
        return $this->userSourceDirector;
    }
}
