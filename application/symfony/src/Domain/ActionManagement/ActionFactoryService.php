<?php

namespace Infinito\Domain\ActionManagement;

use Infinito\Exception\NoDefaultClassException;

/**
 * @author kevinfrantz
 */
final class ActionFactoryService extends AbstractActionConstructor implements ActionFactoryServiceInterface
{
    const BASE_NAMESPACE = 'Infinito\\Domain\\ActionManagement\\';

    const CLASS_SUFFIX = 'Action';

    /**
     * @param string $name
     *
     * @return string
     */
    private function ucfirst(string $name): string
    {
        return ucfirst(strtolower($name));
    }

    /**
     * @param string $action
     * @param string $layer
     *
     * @return string
     */
    private function getClassName(string $action, string $layer = ''): string
    {
        return $this->ucfirst($action).$this->ucfirst($layer).self::CLASS_SUFFIX;
    }

    /**
     * @param string $layer
     * @param string $action
     *
     * @return string
     */
    private function getActionNamespace(string $action, string $layer = ''): string
    {
        return self::BASE_NAMESPACE.$this->ucfirst($action).'\\'.$this->getClassName($action, $layer);
    }

    /**
     * @return string
     */
    private function generateFullClassName(): string
    {
        $requestedAction = $this->actionService->getRequestedAction();
        $action = $requestedAction->getActionType();
        $layer = $requestedAction->getLayer();
        $class = $this->getActionNamespace($action, $layer);
        if (class_exists($class)) {
            return $class;
        }
        $defaultClass = $this->getActionNamespace($action);
        if (class_exists($defaultClass)) {
            return $defaultClass;
        }
        throw new NoDefaultClassException("There is no default substitution class for $class with attributes {layer:\"$layer\",action:\"$action\"}");
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ActionManagement\ActionFactoryServiceInterface::create()
     */
    public function create(): ActionInterface
    {
        $class = $this->generateFullClassName();

        return new $class($this->actionService);
    }
}
