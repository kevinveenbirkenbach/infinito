<?php

namespace Infinito\Domain\Template;

/**
 * @author kevinfrantz
 */
final class ActionTemplateNameService extends TemplateNameService implements ActionTemplateNameServiceInterface
{
    /**
     * @var string
     */
    private $actionType;

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
     * @see \Infinito\Domain\Template\ActionTemplateNameServiceInterface::setActionType()
     */
    public function setActionType(?string $actionType): void
    {
        $this->actionType = $actionType;
    }
}
