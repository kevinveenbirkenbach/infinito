<?php

namespace Infinito\Domain\TemplateManagement;

/**
 * Allows to manually define the action type.
 *
 * @author kevinfrantz
 */
interface ActionTemplateNameServiceInterface extends TemplateNameServiceInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Attribut\ActionTypeAttributInterface::setActionType()
     */
    public function setActionType(?string $actionType): void;
}
