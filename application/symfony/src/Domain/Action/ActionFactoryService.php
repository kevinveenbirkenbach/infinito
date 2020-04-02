<?php

namespace Infinito\Domain\Action;

use Infinito\Exception\NoDefaultClassException;

/**
 * @author kevinfrantz
 */
final class ActionFactoryService extends AbstractActionConstructor implements ActionFactoryServiceInterface
{
    /**
     * @var string Namespace in which the actions will be found
     */
    private const BASE_NAMESPACE = 'Infinito\\Domain\\Action\\';

    /**
     * @var string Suffix for action classes
     */
    private const CLASS_SUFFIX = 'Action';

    private function ucfirst(string $name): string
    {
        return ucfirst(strtolower($name));
    }

    private function getClassName(string $action, string $layer = ''): string
    {
        return $this->ucfirst($action).$this->ucfirst($layer).self::CLASS_SUFFIX;
    }

    private function getActionNamespace(string $action, string $layer = ''): string
    {
        return self::BASE_NAMESPACE.$this->ucfirst($action).'\\'.$this->getClassName($action, $layer);
    }

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
     * @see \Infinito\Domain\Action\ActionFactoryServiceInterface::create()
     */
    public function create(): ActionInterface
    {
        $class = $this->generateFullClassName();

        return new $class($this->actionService);
    }
}
