<?php

namespace Infinito\Domain\RequestManagement\User;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\UserManagement\UserSourceDirectorInterface;
use Infinito\Domain\RequestManagement\Right\RequestedRightInterface;
use Infinito\Domain\RequestManagement\Right\AbstractRequestedRightFacade;
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

    /**
     * @param UserSourceDirectorInterface $userSourceDirector
     */
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
     * @see \Infinito\Domain\RequestManagement\User\RequestedUserInterface::getUserSourceDirector()
     */
    public function getUserSourceDirector(): UserSourceDirectorInterface
    {
        return $this->userSourceDirector;
    }
}
