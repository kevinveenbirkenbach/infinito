<?php

namespace App\Domain\RequestManagement\User;

use App\Entity\Source\SourceInterface;
use App\Domain\UserManagement\UserSourceDirectorInterface;
use App\Exception\SetNotPossibleException;
use App\Domain\RequestManagement\Right\RequestedRightInterface;
use App\Domain\RequestManagement\Right\AbstractRequestedRightFacade;

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
     * {@inheritdoc}
     * @see \App\Attribut\RecieverAttributInterface::setReciever()
     */
    public function setReciever(SourceInterface $reciever): void
    {
        throw new SetNotPossibleException('It\'s not possible to set the reciever! Set it via '.UserSourceDirectorInterface::class.'!');
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
}
