<?php

namespace Infinito\Domain\TemplateManagement;

/**
 * @author kevinfrantz
 */
final class ActionTemplateNameService extends TemplateNameService implements ActionTemplateNameServiceInterface
{
    /**
     * @var string
     */
    private $actionType;

    /**
     * @return string
     */
    protected function getActionType(): string
    {
        if ($this->actionType) {
            return $this->actionType;
        }

        return $this->requestedActionService->getActionType();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\ActionTemplateNameServiceInterface::setActionType()
     */
    public function setActionType(?string $actionType): void
    {
        $this->actionType = $actionType;
    }
}
