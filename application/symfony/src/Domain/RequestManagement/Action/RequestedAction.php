<?php

namespace Infinito\Domain\RequestManagement\Action;

use Infinito\Attribut\ActionTypeAttribut;
use Infinito\DBAL\Types\ActionType;
use Infinito\DBAL\Types\Meta\Right\CRUDType;
use Infinito\Domain\RequestManagement\User\RequestedUser;
use Infinito\Domain\RequestManagement\User\RequestedUserInterface;

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
     * @param RequestedUserInterface $requestedUser
     */
    public function __construct(RequestedUserInterface $requestedUser)
    {
        parent::__construct($requestedUser->getUserSourceDirector(), $requestedUser);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\ActionTypeAttributInterface::setActionType()
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
