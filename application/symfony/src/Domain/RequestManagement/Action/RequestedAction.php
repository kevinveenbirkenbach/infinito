<?php

namespace App\Domain\RequestManagement\Action;

use App\Attribut\ActionTypeAttribut;
use App\DBAL\Types\ActionType;
use App\DBAL\Types\Meta\Right\CRUDType;
use App\Domain\RequestManagement\User\RequestedUser;
use App\Domain\RequestManagement\User\RequestedUserInterface;
use App\Domain\UserManagement\UserSourceDirectorInterface;

/**
 * @author kevinfrantz
 *
 * @todo Implement!
 */
class RequestedAction extends RequestedUser implements RequestedActionInterface
{
    use ActionTypeAttribut{
        setActionType as setActionTypeTrait;
    }

    /**
     * @var array Containes the mapping of non standard actions to a crud
     */
    const ACTION_CRUD_MAP = [
        ActionType::THREAD => CRUDType::READ,
    ];

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RequestManagement\User\RequestedUser::__construct()
     */
    public function __construct(UserSourceDirectorInterface $userSourceDirector, RequestedUserInterface $requestedUser)
    {
        parent::__construct($userSourceDirector, $requestedUser);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Attribut\ActionTypeAttributInterface::setActionType()
     */
    public function setActionType(string $actionType): void
    {
        $this->setActionTypeTrait($actionType);
        $this->setRequestedRightCrudType($actionType);
    }

    /**
     * @param string $actionType
     */
    private function setRequestedRightCrudType(string $actionType): void
    {
        $crudType = $this->getCrudType($actionType);
        $this->requestedRight->setCrud($crudType);
    }

    /**
     * @param string $actionType
     *
     * @return string
     */
    private function getCrudType(string $actionType): string
    {
        if (key_exists($actionType, self::ACTION_CRUD_MAP)) {
            return self::ACTION_CRUD_MAP[$actionType];
        }

        return $actionType;
    }
}
