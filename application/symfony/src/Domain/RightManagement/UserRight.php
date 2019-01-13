<?php

namespace App\Domain\RightManagement;

use App\Entity\Meta\Right;
use App\Entity\Source\SourceInterface;
use App\Exception\SetNotPossibleException;
use App\Domain\UserManagement\UserSourceDirectorInterface;

/**
 * @author kevinfrantz
 */
final class UserRight extends Right implements UserRightInterface
{
    /**
     * @var UserSourceDirectorInterface
     */
    private $userSourceDirector;

    /**
     * @param UserSourceDirectorInterface $userSourceDirector
     */
    public function __construct(UserSourceDirectorInterface $userSourceDirector)
    {
        $this->userSourceDirector = $userSourceDirector;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Entity\Attribut\RecieverAttributInterface::setReciever()
     */
    public function setReciever(SourceInterface $reciever): void
    {
        throw new SetNotPossibleException('This class doesn\'t allow to set a reciever!');
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
}
