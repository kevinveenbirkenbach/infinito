<?php

namespace Infinito\Domain\Action;

use Infinito\Entity\EntityInterface;
use Infinito\Exception\Validation\FormInvalidException;
use Infinito\Exception\Permission\NoPermissionException;

/**
 * @author kevinfrantz
 */
abstract class AbstractAction extends AbstractActionConstructor implements ActionInterface
{
    /**
     * @return bool
     */
    abstract protected function isSecure(): bool;

    /**
     * @return bool
     */
    abstract protected function isValid(): bool;

    /**
     * Process the routine.
     *
     * @return EntityInterface|EntityInterface[]|null
     */
    abstract protected function proccess();

    /**
     * This function can be implemented in the child classes for preparation.
     */
    protected function prepare(): void
    {
        return;
    }

    /**
     * @throws \Exception
     *
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Action\ActionInterface::execute()
     */
    final public function execute(): ?EntityInterface
    {
        $this->prepare();
        if ($this->isSecure()) {
            if ($this->isValid()) {
                return $this->proccess();
            }
            throw new FormInvalidException('The requested Entity is not valid!');
        }
        throw new NoPermissionException("You don't have the permission to execute this action!");
    }
}
