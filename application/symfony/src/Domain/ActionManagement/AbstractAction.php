<?php

namespace App\Domain\ActionManagement;

use App\Entity\EntityInterface;
use App\Exception\NotSecureException;
use App\Exception\NotValidByFormException;

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
     * @throws \Exception
     *
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\ActionInterface::execute()
     */
    final public function execute()
    {
        if ($this->isSecure()) {
            if ($this->isValid()) {
                return $this->proccess();
            }
            throw new NotValidByFormException('The requested Entity is not valid!');
        }
        throw new NotSecureException("You don't have the permission to execute this action!");
    }
}
